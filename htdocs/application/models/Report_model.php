<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_Model extends MY_Model {

    

    public function __construct() {
        parent::__construct();
    }
    
    public function productRemainQtySum($branch=NULL)
    {
        $where = "";
        
        if(!empty($branch)){
            $where .= "stock.branchs_id = ".$this->db->escape($branch);
        }
        
        
        $sql = "SELECT 
                products.product_id,products.product_name,products.product_code
                ,SUM(stock.stock_qty_remaining) AS stock_qty_remaining,stock.branchs_id
                ,branchs.name AS branch_name,branchs.id AS branch_id
                FROM products
                JOIN stock ON products.product_id = stock.product_id
                JOIN branchs ON stock.branchs_id = branchs.id
                WHERE 1                
                AND ${where}
                GROUP BY products.product_id,stock.branchs_id
                ORDER BY branchs.name, stock_qty_remaining";
        
        $rs = $this->db->query($sql);
        $rows = array();
        foreach($rs->result() as $row){
            array_push($rows, $row);
        }
        return $rows;
        
    }

}
