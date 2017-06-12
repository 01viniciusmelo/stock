<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product_model
 *
 * @author Krittkarin.C
 */
class Product_model extends MY_Model {

    public $table = 'product'; // you MUST mention the table name
    public $primary_key = 'product_id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public $delete_cache_on_save = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function search($product_id = NULL) {
        $where = " 1=1 ";
        if (!is_null($product_id)) {
            $where .= " AND `{$this->table}`.`{$this->primary_key}` = {$product_id} ";
        }

        $data = $this->db->query(
                " SELECT `{$this->table}`.*,`category`.`cat_desc` FROM `{$this->table}` "
                . "left join `category` on  `{$this->table}`.`cat_id` = `category`.`cat_id` and `category`.`active` = 1 "
                . "where {$where} "
        );
        return $data;
    }

    public function insert($data = null) {
        if ($this->db->insert($this->table, $data))
            return true;
        return false;
    }

    public function save($product_id = null, $data = null) {
        $this->db->where("{$this->primary_key}", $product_id);
        if ($this->db->update($this->table, $data))
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
