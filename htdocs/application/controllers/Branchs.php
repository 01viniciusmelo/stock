<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Branchs
 *
 * @author Krittkarin.C
 */
class Branchs extends Auth_Controller {

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
        $this->load->model('branch_model');
        $this->load->model('category_model');
    }

    public function index() {
        $this->display();
    }

    public function display() {
        $this->data['title'] = 'All Branchs';

        //Set Branchs Table
        $this->table->set_template($this->tableTemplate);
        $this->table->set_heading( 'Name', 'Address','Email', 'Phone','Mobile','Status', 'Action');


        $branchs = $this->branch_model->search()->result();
        //list Branchs
        foreach ($branchs as $k => $v) {
            $this->table->add_row(
                    //$v->id, 
                    $v->name, 
                    $v->address, 
                    $v->email, 
                    $v->phone, 
                    $v->mobile, 
                    anchor('branchs/deactive/' . $v->id, ($v->active == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'), 
                    anchor('branchs/edit/' . $v->id, '<i class="fa-fw fa fa-edit"></i> Edit','class="btn btn-xs"')."".
                    anchor('stock/branch/' . $v->id, '<i class="fa-fw fa fa-cubes"></i> Stock','class="btn btn-xs"')
                    );
        }
        $this->data['table_data'] = $this->table->generate();

        $this->data['blade'] = "branchs/branchs_display";
        $this->_render_page('template/content', $this->data);
    }

    public function add() {
        $this->data['title'] = 'Add new Branchs';
        $branchs = new stdClass();
        // validate form input
        $this->form_validation->set_rules('name', 'Branchs Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            foreach ($this->input->post() as $k => $v) {
                $branchs->$k = $v;
            }
            $this->data['branchs'] = $branchs;
            $this->data['blade'] = "branchs/branchs_form";
            $this->_render_page('template/content', $this->data);
        } else {
            $save_data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'mobile' => $this->input->post('mobile'),
                'logo_path' => $this->input->post('logo_path'),
                'active' => $this->input->post('active'),
                'created_by' => $this->ion_auth->users()->result()[0]->id,
                'updated_by' => $this->ion_auth->users()->result()[0]->id
            );
            $ret = $this->branch_model->insert($save_data);
            redirect("branchs", 'refresh');
        }
    }

    public function edit($id) {
        $this->data['title'] = 'Edit Branchs';
        $branchs = $this->branch_model->search(null,false,$id);
        if (isset($branchs) && count($branchs->result()) > 0) {
            // validate form input
            $this->form_validation->set_rules('name', 'Branchs Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                foreach ($this->input->post() as $k => $v) {
                    $branchs->$k = $v;
                }
                $this->data['branchs'] = $branchs->result()[0];
                $this->data['blade'] = "branchs/branchs_form";
                $this->_render_page('template/content', $this->data);
            }else{
                $save_data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'mobile' => $this->input->post('mobile'),
                'logo_path' => $this->input->post('logo_path'),
                'active' => $this->input->post('active'),
                'updated_by' => $this->ion_auth->users()->result()[0]->id,
                'updated_at' => mdate($this->_dateFormat,now())
            );
             
            $ret = $this->branch_model->save($id,$save_data);
            redirect("branchs", 'refresh');
            }
        } else
            redirect("branchs", 'refresh');
    }
    
    public function deactive($id){
        $ret = $this->branch_model->toggle_status($id);
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

}
