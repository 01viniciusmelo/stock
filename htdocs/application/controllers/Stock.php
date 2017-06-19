<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category
 *
 * @author Krittkarin.C
 */
class Stock extends Auth_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('stock_model');
        $this->load->model('branch_model');
        $this->load->model('product_model');
    }

    public function index() {
        $this->data['blade'] = "stock/display";
        $this->_render_page('template/content', $this->data);
    }

    public function filter() {
        $data = array('data' => array());
        $this->_render_json($data, 200);
    }

    public function display() {
        
    }

    public function add() {
        $this->data['action'] = 'add';
        // validate form input
        $this->form_validation->set_rules('stock_qty_ori', 'Stock Qty', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->data['branchs'] = array('');
            $branchs = $this->branch_model->read();
            foreach ($branchs as $k => $v) {
                $this->data['branchs'][$v->id] = $v->name;
            }


            $this->data['product'] = array('');
            $product = $this->product_model->read();
            foreach ($product as $k => $v) {
                $this->data['product'][$v->product_id] = $v->product_name;
            }

            //$this->pre($data['product']);
            $this->data['blade'] = "stock/stock_form";
            $this->_render_page('template/content', $this->data);
        } else {

            $save_data = array(
                'product_id' => $this->input->post('product_id'),
                'branchs_id' => $this->input->post('branchs_id'),
                'stock_qty_ori' => $this->input->post('stock_qty_ori'),
                'stock_qty_remaining' => $this->input->post('stock_qty_ori'),
                'active' => 1,
                'created_by' => $this->ion_auth->users()->result()[0]->id,
                'created_at' => mdate($this->_dateFormat, now()),
                'updated_by' => $this->ion_auth->users()->result()[0]->id,
                'updated_at' => mdate($this->_dateFormat, now())
            );
            $ret = $this->stock_model->insert($save_data);
            redirect("stock", 'refresh');
        }
    }

    public function edit($stock_id) {
        $this->data['action'] = 'edit';
        $this->data['stock'] = $this->stock_model->read(array('stock_id' => $stock_id))->result()[0];

        $this->form_validation->set_rules('stock_qty_ori', 'Stock Qty', 'required');
        $this->form_validation->set_rules('stock_qty_new', 'Stock Qty new', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->data['branchs'] = array('');
            $branchs = $this->branch_model->read();
            foreach ($branchs as $k => $v) {
                $this->data['branchs'][$v->id] = $v->name;
            }


            $this->data['product'] = array('');
            $product = $this->product_model->read();
            foreach ($product as $k => $v) {
                $this->data['product'][$v->product_id] = $v->product_name;
            }

            //$this->pre($data['product']);
            $this->data['blade'] = "stock/stock_form";
            $this->_render_page('template/content', $this->data);
        } else {
            $save_data = array(
                'product_id' => $this->input->post('product_id'),
                'branchs_id' => $this->input->post('branchs_id'),
                'stock_qty_ori' => $this->input->post('stock_qty_new') + $this->data['stock']->stock_qty_remaining,
                'stock_qty_remaining' => $this->input->post('stock_qty_new') + $this->data['stock']->stock_qty_remaining,
                'active' => $this->input->post('active'),
                'updated_by' => $this->ion_auth->users()->result()[0]->id,
                'updated_at' => mdate($this->_dateFormat, now())
            );

            $ret = $this->stock_model->save($stock_id, $save_data);
            redirect("stock", 'refresh');
        }
    }

    public function deactive($id) {
        $ret = $this->stock_model->toggle_status($id);
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

    public function transaction() {
        $this->data['blade'] = "stock/transaction";
        $this->_render_page('template/content', $this->data);
    }

}
