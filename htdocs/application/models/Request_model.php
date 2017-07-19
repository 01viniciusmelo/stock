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
class Request_model extends MY_Model {

    public $table = 'request'; // you MUST mention the table name
    public $primary_key = 'request_no'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public $delete_cache_on_save = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function search($search = null, $is_active = false, $is_approval = false) {
        $this->db->select("{$this->table}.*,branchs.name as branchs_name,request_branch.name as branchs_request_name,CONCAT(first_name,' ',last_name) as created_by");
        $this->db->from($this->table);
        $this->db->join('branchs', "branchs.id = {$this->table}.branchs_id and branchs.active=1", 'left');
        $this->db->join('users', "users.id = {$this->table}.created_by and users.active=1", 'left');
        $this->db->join('branchs as request_branch', "request_branch_id.id = {$this->table}.request_branch_id and branchs_to.active=1", 'left');

        if (!is_null($search) && $search != ''):
            $this->db->or_like("{$this->table}.{$this->primary_key}", $search);
            $this->db->or_like("{$this->table}.created_by", $search);
        endif;


        if ($is_active == true)
            $this->db->where("{$this->table}.active", $is_active);

        if ($is_approval == true)
            $this->db->where("{$this->table}.request_status", 'W');


        $data = $this->db->get();
        return $data;
    }

    public function get_request($request_no) {
        $this->db->select("{$this->table}.*,branchs.name as branchs_name,request_branch.name as branchs_request_name,CONCAT(first_name,' ',last_name) as created_by");
        $this->db->from($this->table);
        $this->db->join('branchs', "branchs.id = {$this->table}.branchs_id and branchs.active=1", 'left');
        $this->db->join('branchs as request_branch', "request_branch_id.id = {$this->table}.request_branch_id and branchs_to.active=1", 'left');
        $this->db->join('users', "users.id = {$this->table}.created_by and users.active=1", 'left');
        $this->db->where("{$this->table}.{$this->primary_key}", $request_no);

        $data = $this->db->get();
        return $data;
    }

    public function get_request_item($request_no) {
        $this->db->select("{$this->table}.*,products.product_name,products.product_desc,sale_request_item.product_id,sale_request_item.unit_price,sale_request_item.quantity,sale_request_item.amount,order_status.status_desc,CONCAT(first_name,' ',last_name) as created_by");
        $this->db->from($this->table);
        $this->db->join('request_item', "request_item.request_no = {$this->table}.request_no");
        $this->db->join('products', "products.product_id = request_item.product_id");
        $this->db->join('users', "users.id = {$this->table}.created_by and users.active=1", 'left'); 
        $this->db->where("{$this->table}.{$this->primary_key}", $request_no);

        $data = $this->db->get();
        return $data;
    }

    public function insert($data = null) {
        if ($this->db->insert($this->table, $data))
            return true;
        return false;
    }

    public function insert_item($data = null) {
        if ($this->db->insert_batch('request_item', $data))
            return true;
        return false;
    }

    public function save($id = null, $data = null) {
        $this->db->where("{$this->primary_key}", $id);
        if ($this->db->update($this->table, $data))
            return true;
        return false;
    }

    public function toggle_status($request_no) {
        $q = "UPDATE `{$this->table}` SET `active` = NOT `active` where `{$this->primary_key}`='{$request_no}' ";
        if ($this->db->query($q))
            return true;
        return false;
    }

}
