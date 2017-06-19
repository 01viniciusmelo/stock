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
class Category extends Auth_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }
        $this->load->model('category_model');
    }

    public function index() {
        $this->display();
    }

    public function display() {
        $this->data['title'] = 'All Category';

        //Set Category Table
        $this->table->set_template($this->tableTemplate);
        $this->table->set_heading('ID', 'Name', 'Description', 'Status', 'Action');


        $category = $this->category_model->search()->result();
        //list Category
        foreach ($category as $k => $v) {
            $this->table->add_row($v->cat_id, $v->cat_name, $v->cat_desc, anchor('category/deactive/' . $v->cat_id, ($v->active == 1) ? 'Active' : 'Inactive'), anchor('category/edit/' . $v->cat_id, '<i class="fa-fw fa fa-edit"></i> Edit'));
        }
        $this->data['table_data'] = $this->table->generate();

        $this->data['blade'] = "category/category_display";
        $this->_render_page('template/content', $this->data);
    }

    public function add() {
        $this->data['title'] = 'Add new Category';
        $cat = new stdClass();
        // validate form input
        $this->form_validation->set_rules('cat_name', 'Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            foreach ($this->input->post() as $k => $v) {
                $cat->$k = $v;
            }
            $this->data['cat'] = $cat;
            $this->data['blade'] = "category/category_form";
            $this->_render_page('template/content', $this->data);
        } else {
            $save_data = array(
                'cat_name' => $this->input->post('cat_name'),
                'cat_desc' => $this->input->post('cat_desc'),
                'active' => $this->input->post('active'),
                'created_by' => $this->ion_auth->users()->result()[0]->id,
                'updated_by' => $this->ion_auth->users()->result()[0]->id
            );
            $ret = $this->category_model->insert($save_data);
            redirect("category", 'refresh');
        }
    }

    public function edit($cat_id) {
        $this->data['title'] = 'Edit Category';
        $cat = $this->category_model->search($cat_id);
        if (isset($cat) && count($cat->result()) > 0) {
            // validate form input
            $this->form_validation->set_rules('cat_name', 'Category Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                foreach ($this->input->post() as $k => $v) {
                    $cat->$k = $v;
                }
                $this->data['cat'] = $cat->result()[0];
                $this->data['blade'] = "category/category_form";
                $this->_render_page('template/content', $this->data);
            }else{
                $save_data = array(
                'cat_name' => $this->input->post('cat_name'),
                'cat_desc' => $this->input->post('cat_desc'),
                'active' => $this->input->post('active'),
                'updated_by' => $this->ion_auth->users()->result()[0]->id,
                'updated_at' => mdate($this->_dateFormat,now())
            );
             
            $ret = $this->category_model->save($cat_id,$save_data);
            redirect("category", 'refresh');
            }
        } else
            redirect("category", 'refresh');
    }
    
    public function deactive($cat_id){
        $ret = $this->category_model->toggle_status($cat_id);
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

}
