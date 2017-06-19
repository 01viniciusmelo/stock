<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Branch_Model extends MY_Model {

    public $table = 'branchs'; // you MUST mention the table name
    public $primary_key = 'id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public $delete_cache_on_save = TRUE;

    public function __construct() {
        parent::__construct();
    }

    public function search($key = NULL, $is_active = false, $id = null) {
        $where = " 1=1 ";

        if (!is_null($id)) {
            $where .= " AND `{$this->table}`.`{$this->primary_key}` ={$id} ";
        }

        if ($is_active == true) {
            $where .= " AND `{$this->table}`.`name` LIKE '%{$key}%' ESCAPE '!'
                    OR  `{$this->table}`.`email` LIKE '%{$key}%' ESCAPE '!'
                    OR  `{$this->table}`.`address` LIKE '%{$key}%' ESCAPE '!'
                    OR  `{$this->table}`.`phone` LIKE '%{$key}%' ESCAPE '!' ";
        }

        if ($is_active === true) {
            $where .= " AND `{$this->table}`.`active` IN('Y') ";
        }

        $data = $this->db->query(" SELECT * FROM `{$this->table}` WHERE {$where}");

        return $data;
    }

    public function read($where = array(), $limit = NULL, $offet = 0) {
        $criteria = array('active' => MY_Model::FLAG_DATA_ACTIVE);

        if (!empty($where)) {
            foreach ($where as $f => $v) {
                $criteria[$f] = $v;
            }
        }

        $q = $this->order_by('name', 'ASC');

        if (!is_null($limit)) {
            $q->limit($limit, $offet);
        }

        $data = $q->get_all($criteria);
        //$data = $q->set_cache("customer_read", 500)->get_all($criteria);

        return $data;
    }

    public function insert($data = null) {
        if ($this->db->insert($this->table, $data))
            return true;
        return false;
    }

    public function save($id = null, $data = null) {
        $this->db->where("{$this->primary_key}", $id);
        if ($this->db->update($this->table, $data))
            return true;
        return false;
    }

    public function delete($id = NULL) {
        // update status
        if (!is_null($id)) {
            $where['active'] = 'N';
            $where['id'] = $id;
            $this->update($where, 'id');
            return true;
        }
        return false;
    }

    public function toggle_status($id) {
        $q = "UPDATE `{$this->table}` SET `active` = NOT `active` where `{$this->primary_key}`={$id} ";
        if ($this->db->query($q))
            return true;
        return false;
    }

}
