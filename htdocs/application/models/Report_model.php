<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_Model extends MY_Model {

    

    public function __construct() {
        parent::__construct();
    }
    
    public function productRemainQtySum($branch=NULL,$option=array() )
    {
        $where = "";
        $groups = array();
        $summarys = array();
        
        if(!empty($option['is_group_product']) && $option['is_group_product'] == TRUE){
            array_push($groups, "products.product_id");
        }
        if(!empty($option['is_group_branch']) && $option['is_group_branch'] == TRUE){
            array_push($groups, "stock.branchs_id");
        }
        if(!empty($option['is_group_category']) && $option['is_group_category'] == TRUE){
            array_push($groups, "category.cat_id");
        }
        
        if(!empty($branch)){
            $where .= "AND stock.branchs_id = ".$this->db->escape($branch);
        }
        
        
        // group by
        $group = "";
        $summary = "";
        if(!empty($groups)){
            $group = "GROUP BY ".implode(",", $groups);
            $summary = "SUM(stock.stock_qty_remaining) AS stock_qty_remaining";
        }else{
            $summary = "stock.stock_qty_remaining AS stock_qty_remaining";
        }
        
        $sql = "SELECT 
                products.product_id,products.product_name,products.product_code
                ,category.cat_id,category.cat_name
                ,{$summary},stock.branchs_id
                ,branchs.name AS branch_name,branchs.id AS branch_id
                FROM products
                JOIN category ON products.cat_id = category.cat_id
                JOIN stock ON products.product_id = stock.product_id
                JOIN branchs ON stock.branchs_id = branchs.id
                WHERE 1                
                {$where}
                {$group}
                ORDER BY branchs.name, stock_qty_remaining";
        
        $rs = $this->db->query($sql);
        $rows = array();
        foreach($rs->result() as $row){
            array_push($rows, $row);
        }
        return $rows;
        
    }

}
