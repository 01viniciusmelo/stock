<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category_model
 *
 * @author Krittkarin.C
 */
class Category_model extends MY_Model {

    public $table = 'category'; // you MUST mention the table name
    public $primary_key = 'cat_id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public $delete_cache_on_save = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function search($cat_id = NULL) {
        $where = " 1=1 ";
        if (!is_null($cat_id)) {
            $where .= " AND `{$this->table}`.`{$this->primary_key}` = {$cat_id} ";
        }

        $data = $this->db->query(" SELECT * FROM `{$this->table}` where {$where} ");
        return $data;
    }

    public function insert($data = null) {
        if ($this->db->insert($this->table, $data))
            return true;
        return false;
    }

    public function save($cat_id = null, $data = null) {
        $this->db->where("{$this->primary_key}", $cat_id);
        if ($this->db->update($this->table, $data))
            return true;
        return false;
    }

    public function toggle_status($cat_id) {
        $q = "UPDATE `{$this->table}` SET `active` = NOT `active` where `cat_id`={$cat_id} ";
        if ($this->db->query($q))
            return true;
        return false;
    }

}
