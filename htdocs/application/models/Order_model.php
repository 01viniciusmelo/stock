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
class Order_model extends MY_Model {

    public $table = 'sale_order'; // you MUST mention the table name
    public $primary_key = 'order_no'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public $delete_cache_on_save = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function search($search = null, $is_active = false, $is_approval = false) {
        $this->db->select("{$this->table}.*,reason.reason_title,branchs.name as branchs_name");
        $this->db->from($this->table);
        $this->db->join('reason', "reason.reason_id = {$this->table}.reason_id and reason.active=1", 'left');
        $this->db->join('branchs', "branchs.id = {$this->table}.branchs_id and branchs.active=1", 'left');

        if (!is_null($search) && $search!=''):
            $this->db->or_like("{$this->table}.{$this->primary_key}", $search);
            $this->db->or_like("{$this->table}.created_by", $search);
        endif;


        if ($is_active == true)
            $this->db->where("{$this->table}.active", $is_active);

        if ($is_approval == true)
            $this->db->where("{$this->table}.order_status", 'W');

        $data = $this->db->get();
        return $data;
    }

    public function get_order($order_no) {
        $this->db->select("{$this->table}.*,reason.reason_title,branchs.name as branchs_name");
        $this->db->from($this->table);
        $this->db->join('reason', "reason.reason_id = {$this->table}.reason_id and reason.active=1", 'left');
        $this->db->join('branchs', "branchs.id = {$this->table}.branchs_id and branchs.active=1", 'left');
        $this->db->where("{$this->table}.{$this->primary_key}", $order_no);

        $data = $this->db->get();
        return $data;
    }
    public function get_order_item($order_no) {
        $this->db->select("{$this->table}.*,products.product_name,products.product_desc,sale_order_item.product_id,sale_order_item.unit_price,sale_order_item.quantity,sale_order_item.amount");
        $this->db->from($this->table);
        $this->db->join('sale_order_item', "sale_order_item.order_no = {$this->table}.order_no");
        $this->db->join('products', "products.product_id = sale_order_item.product_id");
        $this->db->where("{$this->table}.{$this->primary_key}", $order_no);

        $data = $this->db->get();
        return $data;
    }

    public function insert($data = null) {
        if ($this->db->insert($this->table, $data))
            return true;
        return false;
    }

    public function insert_item($data = null) {
        if ($this->db->insert_batch('sale_order_item', $data))
            return true;
        return false;
    }

    public function save($id = null, $data = null) {
        $this->db->where("{$this->primary_key}", $id);
        if ($this->db->update($this->table, $data))
            return true;
        return false;
    }

    public function toggle_status($product_id) {
        $q = "UPDATE `{$this->table}` SET `active` = NOT `active` where `{$this->primary_key}`='{$product_id}' ";
        if ($this->db->query($q))
            return true;
        return false;
    }

}
