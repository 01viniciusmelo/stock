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
        
        $this->load->model('stock_model');
        $this->load->model('product_model');
        
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
        
        $this->import_check_product_exists($code);
        
        return $code;
    }
    
    public function import_check_product_exists($code){
        
        $sql = "UPDATE tmp_import_stocks 
                JOIN (	
                        SELECT 
                        product_id
                        ,product_name
                        ,product_number
                        ,product_branch_origin 
                        ,product_branch_present
                        ,branchs.name as location
                        ,category.cat_name  as category
                        FROM 
                        PRODUCTS
                        LEFT JOIN branchs on products.product_branch_origin = branchs.id
                        LEFT JOIN category on products.cat_id  =  category.cat_id
                ) br ON (
                        tmp_import_stocks.code		= ?
                AND	tmp_import_stocks.part_name = br.product_name
                AND 	tmp_import_stocks.part_no = br.product_number
                AND 	tmp_import_stocks.location = br.location
                AND 	tmp_import_stocks.category = br.category
                )
                SET 
                tmp_import_stocks.`exists` = br.product_id
                WHERE (
                        tmp_import_stocks.code		= ?
                AND	tmp_import_stocks.part_name = br.product_name
                AND 	tmp_import_stocks.part_no = br.product_number
                AND 	tmp_import_stocks.location = br.location
                AND 	tmp_import_stocks.category = br.category
                )";
        $result = $this->db->query($sql,array($code,$code));
        
        return TRUE;
        
    }


    public function import_total_code($code=NULL)
    {
        $sql = "SELECT
              COUNT(*) as cnt
              FROM tmp_import_stocks 
              WHERE code = ?
              AND location != 'Location'  AND location != '' AND location IS NOT NULL";
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
                `exists`,
                qty
                -- sum(`qty`) as qty
              FROM tmp_import_stocks
              WHERE code = ?
              AND location != 'Location'
              AND location != ''
              -- GROUP BY category,location,part_name,part_no
              ORDER BY qty DESC
              ";
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
              AND location != 'Location'
              AND location != ''
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
        
        
        $this->db->trans_start();
        
        // get new branch
        $sql_branch = " SELECT DISTINCT `location` AS location
                        FROM tmp_import_stocks
                        WHERE code = ?
                        AND location NOT IN (
                                SELECT DISTINCT name FROM branchs
                        )
                        AND location != 'Location' AND location != \"\" ";
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
                        AND location != 'Location'  AND location != \"\"";
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
                `price`,
                `exists`
              FROM tmp_import_stocks
              LEFT JOIN category ON category.cat_name = tmp_import_stocks.category
              LEFT JOIN branchs ON branchs.name = tmp_import_stocks.location
              WHERE code = ?              
              AND ( tmp_import_stocks.location != 'Location' AND tmp_import_stocks.location != '' )
              ";
        $result = $this->db->query($sql,$code);
        //echo $this->db->last_query(); 
        $rows = array();
        $branchs = array();        
        $products_new= array();
        $products_exists= array();
        $i = 0;        
        //insert new
        $date  = date('YmdHis');
        foreach ($result->result() as $row) {
            
            // product exists
            if($row->exists != 0  ){
                 $data = array(                    
                    "product_price_selling"  => $row->price,
                    "product_price_purchasing"   => $row->price,                    
                    "product_branch_present" => $row->location_id,                    
                    "quantity"   => empty($row->qty) ? 0 :$row->qty,
                    "product_branch_origin"  => $row->location_id,
                    "updated_by" => $this->user->id,
                    "updated_at" => $created_at,                    
                    "product_id" => $row->exists
                );
                array_push($products_exists, $data);      
            }
            
            // product new 
            if($row->exists == 0 ){
                 $data = array(
                    "product_code"   => "EXCEL_IMP_".$date. sprintf("%04d",$i),
                    "product_name"   => $row->part_name,
                    "product_number" => $row->part_no,
                    "product_desc"   => "EXCEL_IMP_".$date.sprintf("%04d",$i),
                    "product_price_selling"  => $row->price,
                    "product_price_purchasing"   => $row->price,
                    "product_branch_origin"  => $row->location_id,
                    "product_branch_present" => $row->location_id,
                    "unit"  => "",
                    "cat_id" => $row->cat_id,
                    "quantity"   => empty($row->qty) ? 0 :$row->qty,
                    "created_by" => $this->user->id,
                    "created_at" => $created_at,
                    "active" => Excel_model::FLAG_DATA_ACTIVE             
                );
                //array_push($products_new, $data);      
                
                // update stock                              
                $this->product_model->addStock($data);
            }
            
            $i++;
        }
        
        //$this->db->insert_batch('products', $products_new);
        // update exists record        
        //$this->db->update_batch('products', $products_exists, 'product_id');
        $affected_rows  = 0;
        foreach($products_exists as  $prod)
        {
            // update product qty
            $this->db->query("UPDATE products  SET "
                    . "product_price_selling = '{$prod['product_price_selling']}', "
                    . "product_price_purchasing = '{$prod['product_price_purchasing']}', "
                    . "product_branch_present = '{$prod['product_branch_present']}',   "
                    . "quantity = `quantity`+{$prod['quantity']},   "
                    . "updated_by = '{$prod['updated_by']}',   "
                    . "updated_at = '{$prod['updated_at']}'   "
                    . "WHERE product_id = {$prod['product_id']} ");
            $affected_rows += $this->db->affected_rows();
            
            
            // update stock qty
            $this->stock_model->update_stock($prod['product_id'], $prod['product_branch_origin'], $prod['quantity'], Stock_Model::ACTION_UPDATE_INCREASE);
        }
        
        
        $this->db->trans_complete();
        
        return true;
    }
    
    public function insert($data = NULL,$table=NULL) {
        if(!is_null($table)){
            $this->table=$table;
        }
        parent::insert($data);
    }

}
