<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stock_Model extends MY_Model {

    public $table = 'stock'; // you MUST mention the table name
    public $primary_key = 'stock_id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public $delete_cache_on_save = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function read($where = array(), $limit = NULL, $offet = 0, $is_active = false) {

        $this->db->select("{$this->table}.*,products.product_name,branchs.name");
        $this->db->from($this->table);
        $this->db->join('products', "products.product_id = {$this->table}.product_id");
        $this->db->join('branchs', "branchs.id = {$this->table}.branchs_id");

        if (!empty($where)) {
            foreach ($where as $f => $v) {
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

    public function update_stock($product_id, $branchs_id, $qty) {
        $this->db->where("product_id", $product_id);
        $this->db->where("branchs_id", $branchs_id);
        $this->db->set('stock_qty_remaining', "stock_qty_remaining-{$qty}", FALSE);

        if ($this->db->update($this->table))
            return true;
        return false;
    }

    public function toggle_status($product_id) {
        $q = "UPDATE `{$this->table}` SET `active` = NOT `active` where `{$this->primary_key}`={$product_id} ";
        if ($this->db->query($q))
            return true;
        return false;
    }

}
