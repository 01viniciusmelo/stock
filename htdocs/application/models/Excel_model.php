<?php

require_once(APPPATH . 'libraries/PhpSpreadsheet/src/Bootstrap.php');
require_once(APPPATH . 'libraries/Excel_ReadFilter.php');
ini_set('memory_limit', '1024M');
ini_set('max_execution_time', 300);

//use PhpOffice\PhpSpreadsheet\IOFactory;
/**
 * Description of Excel_model
 *
 * @author joe
 */
class Excel_model extends MY_Model {
    
    private $user;
    public function __construct() {
        parent::__construct();
        
        $this->load->helper('string');
        
        $this->user = $this->ion_auth->user()->row();

    }
    
    public function import_stock($upload = null) {
        
        $filepath   = $upload['full_path'];
        $fileorig   = $upload['orig_name'];
        $code       = random_string('alnum', 16);
        $created_at = date($this->timestamps_format);
        $created_by = $_SESSION['user_id'];
        /**  Identify the type of $inputFileName  * */
        $fileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($filepath);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($fileType);
        $reader->setReadDataOnly(TRUE);
        $reader->setReadFilter(new Excel_ReadFilter(1, 5000, range('A', 'F')));
        $spreadsheet = $reader->load($filepath);

        $tmps = array();
        foreach ($spreadsheet->getActiveSheet()->getRowIterator() as $row) {
            
            if ($spreadsheet->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {

                $rowExcel = array();
                $rowExcel['import_file_name'] = $fileorig;
                $rowExcel['category'] = $spreadsheet->getActiveSheet()->getCell('A' . $row->getRowIndex())->getValue();
                $rowExcel['location'] = $spreadsheet->getActiveSheet()->getCell('B' . $row->getRowIndex())->getValue();
                $rowExcel['part_name'] = $spreadsheet->getActiveSheet()->getCell('C' . $row->getRowIndex())->getValue();
                $rowExcel['part_no'] = $spreadsheet->getActiveSheet()->getCell('D' . $row->getRowIndex())->getValue();
                $rowExcel['qty'] = $spreadsheet->getActiveSheet()->getCell('E' . $row->getRowIndex())->getValue();
                $rowExcel['price'] = $spreadsheet->getActiveSheet()->getCell('F' . $row->getRowIndex())->getFormattedValue();
                $rowExcel['file_type'] = $fileType;
                $rowExcel['code'] = $code;
                $rowExcel['created_at'] = $created_at;
                $rowExcel['created_by'] = $created_by;
                array_push($tmps, $rowExcel);
            }
        }

        $this->db->insert_batch('tmp_import_stocks', $tmps);
        return $code;
    }
    
    public function import_total_code($code=NULL)
    {
        $sql = "SELECT
              COUNT(*) as cnt
              FROM tmp_import_stocks 
              WHERE code = ?
              AND location != 'Location'";
        $result = $this->db->query($sql,$code);
        $rows = array();
        foreach ($result->result() as $row) {
            array_push($rows, $row);
        }
        return $rows;
        
    }
    
    public function import_read_code($code=NULL)
    {
        $sql = "SELECT
                `category`,
                `location`,
                `part_name`,
                `part_no`,
                sum(`qty`) as qty
              FROM tmp_import_stocks
              WHERE code = ?
              AND location != 'Location'
              GROUP BY category,location,part_name,part_no
              LIMIT 10";
        $result = $this->db->query($sql,$code);
        $rows = array();
        foreach ($result->result() as $row) {
            array_push($rows, $row);
        }
        return $rows;
        
    }
    
    public function import_name_code($code=NULL)
    {
         $sql = "SELECT
              import_file_name as filename
              FROM tmp_import_stocks 
              WHERE code = ?
              LIMIT 1";
        $result = $this->db->query($sql,$code);
        $rows = array();
        foreach ($result->result() as $row) {
            array_push($rows, $row);
        }
        return $rows;
        
    }
    
    public function import_delete_code($code=NULL)
    {
        $this->db->delete('tmp_import_stocks', array('code' => $code));
    }
    
    public function import_approved_code($code=NULL)
    {
        $created_at = date($this->timestamps_format);
        $created_by = $this->user->id;
        // get new branch
        $sql_branch = " SELECT DISTINCT `location` AS location
                        FROM tmp_import_stocks
                        WHERE code = ?
                        AND location NOT IN (
                                SELECT DISTINCT name FROM branchs
                        )
                        AND location != 'Location'";
        $result = $this->db->query($sql_branch,$code);
        foreach ($result->result() as $row) {
            $data = array(
                    "name"  => $row->location ,
                    //"email" => "IMPORT_EXCEL@{$this->user->email}",
                    "active"    => 1,
                    "created_by" => $this->user->id
            );
            $this->insert($data,"branchs");
        }
        
        
        // get new category
        $sql_category = " SELECT DISTINCT `category` AS category
                        FROM tmp_import_stocks
                        WHERE code = ?
                        AND category NOT IN (
                                SELECT DISTINCT cat_name FROM category
                        )
                        AND location != 'Location'";
        $result = $this->db->query($sql_category,$code);
        foreach ($result->result() as $row) {
            $data = array(
                    "cat_name"  => $row->category ,
                    "cat_desc" => "IMPORT_EXCEL@{$this->user->email}",
                    "active"    => 1,
                    "created_by" => $this->user->id
            );
            $this->insert($data,"category");
        }
        
        
        $sql = "SELECT
                `category`,
                `category`.cat_id as cat_id,
                `location`,
                `branchs`.`id` AS location_id,
                `part_name`,
                `part_no`,
                `qty`,
                `price`
              FROM tmp_import_stocks
              LEFT JOIN category ON category.cat_name = tmp_import_stocks.category
              LEFT JOIN branchs ON branchs.name = tmp_import_stocks.location
              WHERE code = ?
              AND location != 'Location'
              ";
        $result = $this->db->query($sql,$code);
        $rows = array();
        $branchs = array();
        
        $products= array();
        foreach ($result->result() as $row) {
            
            $data = array(
                //"product_code"   => ,
                "product_name"   => $row->part_name,
                "product_number" => $row->part_no,
                "product_desc"   => "IMPORT_EXCEL@{$this->user->email}",
                "product_price_selling"  => $row->price,
                //"product_price_purchasing"   => ,
                "product_branch_origin"  => $row->location_id,
                "product_branch_present" => $row->location_id,
                "cat_id" => $row->cat_id,
                "quantity"   => $row->qty,
                "created_by" => $this->user->id,
                "created_at" => $created_at,
                "active" => Excel_model::FLAG_DATA_ACTIVE
            );
            
            // product
            array_push($products, $data);
        }
        
        $this->db->insert_batch('products', $products);
        return true;
    }
    
    public function insert($data = NULL,$table=NULL) {
        if(!is_null($table)){
            $this->table=$table;
        }
        parent::insert($data);
    }

}
