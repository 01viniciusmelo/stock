<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stock_Model extends MY_Model {

    //constant $STATUS_DECREASE = 'decrease';

    public $table = 'stock'; // you MUST mention the table name
    public $primary_key = 'stock_id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public $delete_cache_on_save = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function read($where = array(), $limit = NULL, $offet = 0, $is_active = false) {

        $this->db->select("{$this->table}.* ,`products`.`product_name`
                                            ,`products`.`product_id`
                                            ,`products`.`product_code`
                                            ,`products`.`product_number`
                                            ,`products`.`product_price_selling`
                                            ,`branchs`.`id` AS branch_id
                                            ,`branchs`.`name` ");
        $this->db->from($this->table);
        $this->db->join('products', "products.product_id = {$this->table}.product_id");
        $this->db->join('branchs', "branchs.id = {$this->table}.branchs_id");

        if (!empty($where)) {
            foreach ($where as $f => $v) {
                if($f=='stock.product_id'){
                    $this->db->where($f, $v);
                }else
                $this->db->or_where($f, $v);
            }
        }
        
       

        if ($is_active == true) {
            $this->db->where("{$this->table}.active", MY_Model::FLAG_DATA_ACTIVE);
        }


        if (!is_null($limit)) {
            $this->db->limit($limit, $offet);
        }

        $data = $this->db->get();
        return $data;
    }

    public function check_stock_empty($product_id, $branchs_id) {
        $this->db->from($this->table);
        $this->db->where("{$this->table}.product_id", $product_id);
        $this->db->where("{$this->table}.branchs_id", $branchs_id);
        $this->db->where("{$this->table}.active", MY_Model::FLAG_DATA_ACTIVE);
        $data = $this->db->get();
        if ($data->num_rows() >= 1)
            return false;
        return true;
    }

    public function insert($data = null) {
        if ($this->db->insert($this->table, $data))
            return true;
        return false;
    }

    public function save($product_id, $data = null) {
        $this->db->where("{$this->primary_key}", $product_id);
        if ($this->db->update($this->table, $data))
            return true;
        return false;
    }

    public function update_stock($product_id, $branchs_id, $qty, $by = 'decrease') {
        $this->db->cache_delete_all();
        $this->db->where("product_id", $product_id);
        $this->db->where("branchs_id", $branchs_id);

        if ($by == 'decrease') {
            $this->db->set('stock_qty_remaining', "stock_qty_remaining-{$qty}", FALSE);
            $this->db->update($this->table);
        } else {
            $check_empty = $this->check_stock_empty($product_id, $branchs_id);
            if ($check_empty == true):
                $save_data = array(
                    'product_id' => $product_id,
                    'branchs_id' => $branchs_id,
                    'stock_qty_ori' => $qty,
                    'stock_qty_remaining' => $qty,
                    'stock_remark' => 'Transfer',
                    'active' => 1,
                    'created_at' => mdate('%Y-%m-%d %H:%i:%s', now()),
                    'updated_at' => mdate('%Y-%m-%d %H:%i:%s', now())
                );
                $this->insert($save_data);
            else:
                $this->db->set('stock_qty_remaining', "stock_qty_remaining+{$qty}", FALSE);
                $this->db->update($this->table);
            endif;
        }
        return true;
    }

    public function toggle_status($product_id) {
        $q = "UPDATE `{$this->table}` SET `active` = NOT `active` where `{$this->primary_key}`={$product_id} ";
        if ($this->db->query($q))
            return true;
        return false;
    }
    
    public function readProduct($branch_id,$product_id)
    {
        $sql = "SELECT `stock`.*, 
                `products`.`product_name`
                ,`products`.`product_id`
                ,`products`.`product_code`
                ,`products`.`product_number`
                ,`branchs`.`name` 
                FROM `stock` JOIN `products` ON `products`.`product_id` = `stock`.`product_id` 
                JOIN `branchs` ON `branchs`.`id` = `stock`.`branchs_id` 
                WHERE `branchs`.`id` = ? 
                AND `products`.`product_id` = ?";
        $result = $this->db->query($sql,array($branch_id,$product_id));
        $rows = array();
        foreach ($result->result() as $row) {
            array_push($rows, $row);
        }
        return $rows;
        
    }
    
    public function createTransferStock($data=array()){
        if(!empty($data)){
            
            $this->table = "product_transfers";
            $this->db->trans_start();
            
            parent::insert($data);
            // update product qty
            $sql = "UPDATE `products` 
                   SET 
                   `quantity` = quantity-? , 
                   `updated_at` = ? ,
                   `updated_by` = ? 
                   WHERE `product_id` = ? ";
            $this->db->query($sql,array(
                intval($data['quantity']),
                date($this->timestamps_format),
                $this->session->userdata('user_id'),
                $data['product_id']
            ));
            
             // update stock qty
            $sql = "UPDATE `stock` 
                   SET 
                   `stock_qty_remaining` = stock_qty_remaining-? , 
                   `updated_at` = ? ,
                   `updated_by` = ? 
                   WHERE `product_id` = ? AND `branchs_id` = ? ";
            $this->db->query($sql,array(
                intval($data['quantity']),
                date($this->timestamps_format),
                $this->session->userdata('user_id'),
                $data['product_id'],
                $data['branch_from']
            ));
            
            
            $this->db->trans_complete();
            
            
        }
    }
    
    public function readTranferJob($transID){
        $sql = "SELECT product_transfers.* ,
                bf.name AS branch_from_name,
                bt.name AS branch_to_name,
                p.product_name as product_name,
                p.product_number as product_number
                FROM product_transfers
                LEFT JOIN branchs bf ON product_transfers.`branch_from` = bf.id
                LEFT JOIN branchs bt ON product_transfers.`branch_to` = bt.id
                LEFT JOIN products p ON product_transfers.`product_id` =  p.`product_id`
                WHERE trans_no = ?";
        $result =$this->db->query($sql,$transID);
        $rows = array();
        foreach ($result->result() as $row) {
            array_push($rows, $row);
        }
        return $rows;
    }


    public function updateTransferStock($from,$to,$product,$qty){
        
    }

}
