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

    public function __construct() {
        parent::__construct();
        
        $this->load->helper('string');

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
        $sql = "SELECT
                `category`,
                `location`,
                `part_name`,
                `part_no`,
                `qty`
              FROM tmp_import_stocks
              WHERE code = ?
              AND location != 'Location'
              ";
        $result = $this->db->query($sql,$code);
        $rows = array();
        $branchs = array();
        $category= array();
        $products= array();
        foreach ($result->result() as $row) {
            
            // branch
            array_push($branchs, $row->location);
            // category
            array_push($category, $row->location);
            
            // product
            array_push($products, $row);
        }
        return $branchs;
    }

}
