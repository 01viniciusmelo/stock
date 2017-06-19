<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reason
 *
 * @author Krittkarin.C
 */
class Reason extends Auth_Controller {

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
        $this->load->model('reason_model');
    }

    public function index() {
        $this->display();
    }

    public function display() {
        $this->data['title'] = 'All Reason';

        //Set Reason Table
        $this->table->set_template($this->tableTemplate);
        $this->table->set_heading('ID', 'Title', 'Description', 'Status', 'Action');


        $reason = $this->reason_model->search()->result();
        //list Reason
        foreach ($reason as $k => $v) {
            $this->table->add_row($v->reason_id, $v->reason_title, $v->reason_desc, anchor('reason/deactive/' . $v->reason_id, ($v->active == 1) ? 'Active' : 'Inactive'), anchor('reason/edit/' . $v->reason_id, '<i class="fa-fw fa fa-edit"></i> Edit'));
        }
        $this->data['table_data'] = $this->table->generate();

        $this->data['blade'] = "reason/reason_display";
        $this->_render_page('template/content', $this->data);
    }

    public function add() {
        $this->data['title'] = 'Add new Reason';
        $reason = new stdClass();
        // validate form input
        $this->form_validation->set_rules('reason_title', 'Reason Title', 'required');

        if ($this->form_validation->run() == FALSE) {
            foreach ($this->input->post() as $k => $v) {
                $reason->$k = $v;
            }
            $this->data['cat'] = $reason;
            $this->data['blade'] = "reason/reason_form";
            $this->_render_page('template/content', $this->data);
        } else {
            $save_data = array(
                'reason_title' => $this->input->post('reason_title'),
                'reason_desc' => $this->input->post('reason_desc'),
                'active' => $this->input->post('active'),
                'created_by' => $this->ion_auth->users()->result()[0]->id,
                'updated_by' => $this->ion_auth->users()->result()[0]->id
            );
            $ret = $this->reason_model->insert($save_data);
            redirect("reason", 'refresh');
        }
    }

    public function edit($reason_id) {
        $this->data['title'] = 'Edit Reason';
        $reason = $this->reason_model->search($reason_id);
        if (isset($reason) && count($reason->result()) > 0) {
            // validate form input
            $this->form_validation->set_rules('reason_title', 'Reason Title', 'required');
            if ($this->form_validation->run() == FALSE) {
                foreach ($this->input->post() as $k => $v) {
                    $reason->$k = $v;
                }
                $this->data['reason'] = $reason->result()[0];
                $this->data['blade'] = "reason/reason_form";
                $this->_render_page('template/content', $this->data);
            }else{
                $save_data = array(
                'reason_title' => $this->input->post('reason_title'),
                'reason_desc' => $this->input->post('reason_desc'),
                'active' => $this->input->post('active'),
                'updated_by' => $this->ion_auth->users()->result()[0]->id,
                'updated_at' => mdate($this->_dateFormat,now())
            );
             
            $ret = $this->reason_model->save($reason_id,$save_data);
            redirect("reason", 'refresh');
            }
        } else
            redirect("reason", 'refresh');
    }
    
    public function deactive($reason_id){
        $ret = $this->reason_model->toggle_status($reason_id);
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

}
