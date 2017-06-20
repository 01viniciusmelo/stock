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
        $this->load->model('excel_model');
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
    
    public function import($action="import",$code=NULL) {
        if($action=="import"){
            $this->_import();
        }
        
        if($action=="example"){
            $this->_import_example($code);
        }
        
        if($action=="approved"){
            $this->excel_model->import_approved_code($code);
        }
        
        if($action=="reject"){
            $this->excel_model->import_delete_code($code);
        }
        
        
        
    }
    
    private function _import()
    {
        if (!empty($_POST)) {
            
            if ($this->_valid_csrf_nonce() === FALSE  ) {
                show_error($this->lang->line('error_csrf'));
            }
            
            $config['upload_path'] = temp_dir();
            $config['encrypt_name'] = TRUE;
            $config['allowed_types'] = 'xls|xlsx';
            $config['max_size'] = 10000;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('upload_excle_file')) {
                $error = array('error' => $this->upload->display_errors());
                show_error($error);
                
            } else {
                $data = array('upload_data' => $this->upload->data());
                
                $this->load->model('excel_model');
                $code = $this->excel_model->import_stock($data['upload_data']);
                redirect("stock/import/example/{$code}");
            }
        }else{

            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['blade'] = "stock/import_excel";
            $this->_render_page('template/content', $this->data);
        }
    }


    private function _import_example($uploadCode=NULL)
    {   
        $this->data['filename'] = $this->excel_model->import_name_code($uploadCode);
        $this->data['code'] = $uploadCode;
        $this->data['total'] = $this->excel_model->import_total_code($uploadCode);
        $this->data['examples'] = $code = $this->excel_model->import_read_code($uploadCode);
        $this->data['blade'] = "stock/imported_excel";
        $this->_render_page('template/content', $this->data);
    }
    
     private function _import_remove($uploadCode=NULL)
    {   
        $this->data['filename'] = $this->excel_model->import_name_code($uploadCode);
        $this->data['code'] = $uploadCode;
        $this->data['total'] = $this->excel_model->import_total_code($uploadCode);
        $this->data['examples'] = $code = $this->excel_model->import_read_code($uploadCode);
        $this->data['blade'] = "stock/imported_excel";
        $this->_render_page('template/content', $this->data);
    }

}
