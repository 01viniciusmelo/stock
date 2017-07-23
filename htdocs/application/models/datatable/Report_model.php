<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Report_Model
 * for datatable
 */

class Report_Model extends MY_Model {

    private $draw = 0;
    private $recordsTotal = 0;
    private $recordsFiltered = 0;
    private $data = array();
    private $columns = array();
    private $order = array();
    private $fields = array();

    public function __construct() {
        parent::__construct();
    }

    public function productRemainQtySum($branch = NULL, $option = array(), $offet = NULL, $limit = NULL) {
        $where = "";
        $groups = array();
        $summarys = array();

        if (!empty($option['is_group_product']) && $option['is_group_product'] == TRUE) {
            array_push($groups, "products.product_id");
        }
        if (!empty($option['is_group_branch']) && $option['is_group_branch'] == TRUE) {
            array_push($groups, "stock.branchs_id");
        }
        if (!empty($option['is_group_category']) && $option['is_group_category'] == TRUE) {
            array_push($groups, "category.cat_id");
        }

        if (!empty($branch)) {
            $where .= "AND stock.branchs_id = " . $this->db->escape($branch);
        }


        // group by
        $group = "";
        $summary = "";
        $offsetlimit = "";
        $orderby = " ORDER BY branchs.name, stock_qty_remaining ";

        if (!empty($groups)) {
            $group = "GROUP BY " . implode(",", $groups);
            $summary = "SUM(stock.stock_qty_remaining) AS stock_qty_remaining";
        } else {
            $summary = "stock.stock_qty_remaining AS stock_qty_remaining";
        }

        // limit offset
        if (!is_null($offsetlimit)) {
            $offsetlimit = " LIMIT $offet,$limit";
        }

        // order by 
        if (!empty($this->getOrder())) {
            $tmpOrder = array();
            foreach ($this->order as $order_col) {
                if (!empty($this->columns[$order_col['column']])) {
                    $sort_field = $this->columns[$order_col['column']]['data'];
                    $sort_dir = $order_col['dir'];
                    array_push($tmpOrder, "  {$sort_field} {$sort_dir}");
                }
            }

            $orderby = " ORDER BY  " . implode(",", $tmpOrder);
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
                ";


        $rs = $this->db->query($sql . $orderby . $offsetlimit);
        $rows = array();
        foreach ($rs->result() as $row) {
            array_push($rows, $row);
        }

        // set data
        $cnt = $this->countQuery($sql);
        $this->setData($rows);
        $this->setRecordsTotal($cnt);
        $this->setRecordsFiltered($cnt);

        return $this;
    }

    private function countQuery($strQuery = "") {
        if (empty($strQuery)) {
            return FALSE;
        }

        $sql = "SELECT COUNT(*) cnt FROM ( {$strQuery} ) tmp";
        $rs = $this->db->query($sql);
        return $rs->row(1)->cnt;
    }

    public function getDraw() {
        return $this->draw;
    }

    public function getRecordsTotal() {
        return $this->recordsTotal;
    }

    public function getRecordsFiltered() {
        return $this->recordsFiltered;
    }

    public function getData() {
        return $this->data;
    }

    public function setDraw($draw) {
        $this->draw = $draw;
    }

    public function setRecordsTotal($recordsTotal) {
        $this->recordsTotal = $recordsTotal;
    }

    public function setRecordsFiltered($recordsFiltered) {
        $this->recordsFiltered = $recordsFiltered;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getColumns() {
        return $this->columns;
    }

    public function setColumns($columns) {
        $this->columns = $columns;
        return $this;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setOrder($order) {
        $this->order = $order;
        return $this;
    }

    public function getFields() {

        if (!empty($this->columns)) {
            foreach ($this->columns as $col_data) {
                array_push($this->fields, $col_data['data']);
            }
        }

        return $this->fields;
    }

    public function setFields($fields) {
        $this->fields = $fields;
        return $this;
    }

}
