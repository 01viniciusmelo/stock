<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Category
 *
 * @author Cheewaphat L.
 */
class Request extends Auth_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();

        $this->load->model('product_model');
        $this->load->model('request_model');
        $this->load->model('branch_model');
        $this->load->helper('number');
    }

    public function index() {
//        $this->_render_page('template/content', $this->data);
        $this->display();
    }

    public function display() {
        $this->data['title'] = 'All Request';


        //Set  Table Search
        $template = array(
            'table_open' => '<table id="request_list" class="request_list table table-striped table-brequested table-hover no-footer" cellspacing="0" width="100%">'
        );
        $this->table->set_template($template);
        $this->table->set_heading(
                'Request No.', '<i class="fa fa-calendar"></i> Request Date', 'Qty', 'Reason', 'Request From Branch','Request Branch', 'By', 'Request Status', 'Active', 'Action'
        );
        $this->data['request_list'] = $this->table->generate();


        $this->data['blade'] = "request/request_display";
        $this->_render_page('template/content', $this->data);
    }

    /* public function view($request_no) {
        $this->data['title'] = 'View request : ' . $request_no;

        $this->data['request'] = $this->request_model->get_request($request_no)->result();
        $request_item = $this->request_model->get_request_item($request_no)->result();

        if (count($request_item) <= 0)
            redirect('request', 'refresh');

        //Set  Table template
        $template = array(
            'table_open' => '<table class="table table-hover" cellspacing="0" width="100%">'
        );
        $this->table->set_template($template);
        $this->table->set_heading('NO.', 'ITEM', 'DESCRIPTION', 'UNIT PRICE', 'QTY', 'TOTAL');
        //list Category
        foreach ($request_item as $k => $v) {
            $this->table->add_row($k + 1, $v->product_name, $v->product_desc, number_format($v->unit_price, 2), number_format($v->quantity, 2), number_format($v->amount, 2));
        }

        $this->table->add_row('SUB TOTAL', '', '', '', '', '<strong>' . number_format($request_item[0]->request_subtotal, 2) . '</strong>');
        $this->table->add_row('DISCOUNT', '', '', '', '', number_format($request_item[0]->request_discount, 2));
        $this->table->add_row('TAX', '', '', '', '', number_format($request_item[0]->request_tax, 2) . '%');
        //$this->table->add_row('<>TOTAL</strong>','','','',  '<strong>'.number_format($request_item[0]->request_total,2).'</strong>' );
        $this->data['request_item_list'] = $this->table->generate();


        $this->data['request_no'] = $request_no;
        $this->data['blade'] = "request/request_view_detail";
        $this->_render_page('template/content', $this->data);
    } */

    public function create_request($request_id = null) {
        $this->data['title'] = 'Create Request';

        // validate form input
        $this->form_validation->set_rules('request_no', 'Request No', 'required');
        $this->form_validation->set_rules('request_remark', 'Remark', 'required');
        if ($this->form_validation->run() == FALSE) :


            $this->data['action_type'] = 'RQ'; //RQ = Request
            $this->data['request_no'] = $this->gen_id($this->data['action_type'], null);

            //Set  Table Search
            $template = array(
                'table_open' => '<table id="search_item" class=" search_item table table-striped table-bordered table-hover no-footer" cellspacing="0" width="100%">'
            );
            $this->table->set_template($template);
            $this->table->set_heading('Name', 'In-stock', 'Action');
            $this->data['search_item'] = $this->table->generate();

            //Set  Table Cart
            $template = array(
                'table_open' => '<table id="cart_item" class="cart_item table table-striped table-bordered table-hover no-footer" cellspacing="0" width="100%">'
            );

            //Set Branchs
            $this->data['branch'] = array();
            $branch = $this->branch_model->read();
            foreach ($branch as $k => $v):
                $this->data['branch'][$v->id] = $v->name;
            endforeach;

            $this->table->set_template($template);
            $this->table->set_heading('Name', 'Qty', 'Action');
            $this->data['cart_item'] = $this->table->generate();

            $this->data['blade'] = "request/request_form";
            $this->_render_page('template/content', $this->data);
        else:

            $save_data_request = array(
                'request_no' => $this->input->post('request_no'),
                'request_remark' => $this->input->post('request_remark'),
                'active' => 1,

                'branchs_id' => $this->_branchs['branch_id'], //user branchs_id
                'request_branch_id' => $this->input->post('request_branch_id'),
                'created_by' => $this->ion_auth->users()->result()[0]->id,
                'created_at' => mdate($this->_dateFormat, now()),
                'updated_by' => $this->ion_auth->users()->result()[0]->id,
                'updated_at' => mdate($this->_dateFormat, now())
            );
            if ($this->request_model->insert($save_data_request)):
                    $this->session->unset_userdata('cart_item');
                    redirect("request/display", 'refresh');
            endif;
        endif;
    }

    public function cancel($request_no) {
        $this->form_validation->set_rules('request_cancel_remark', 'Cancel Remark', 'required');
        if ($this->form_validation->run() == FALSE) :
            $this->data['title'] = 'Cancel request : ' . $request_no;

            $this->data['request'] = $this->request_model->get_request($request_no)->result();
            $request_item = $this->request_model->get_request_item($request_no)->result();

            if (count($request_item) <= 0)
                redirect('request', 'refresh');

            //Set  Table template
            $template = array(
                'table_open' => '<table class="table table-hover" cellspacing="0" width="100%">'
            );
            $this->table->set_template($template);
            $this->table->set_heading('NO.', 'ITEM', 'DESCRIPTION', 'UNIT PRICE', 'QTY', 'TOTAL');
            //list Category
            foreach ($request_item as $k => $v) {
                $this->table->add_row($k + 1, $v->product_name, $v->product_desc, number_format($v->unit_price, 2), number_format($v->quantity, 2), number_format($v->amount, 2));
            }

            $this->table->add_row('SUB TOTAL', '', '', '', '', '<strong>' . number_format($request_item[0]->request_subtotal, 2) . '</strong>');
            $this->table->add_row('DISCOUNT', '', '', '', '', number_format($request_item[0]->request_discount, 2));
            $this->table->add_row('TAX', '', '', '', '', number_format($request_item[0]->request_tax, 2) . '%');
            $this->data['request_item_list'] = $this->table->generate();


            $this->data['request_no'] = $request_no;
            $this->data['blade'] = "request/request_cancel_form";
            $this->_render_page('template/content', $this->data);

        else:
            $this->load->model('stock_model');
            $request = $this->request_model->get_request($request_no)->result();
            if (count($request) == 1):
                $data = array(
                    'request_status' => 'C',
                    'request_cancel_remark' => $this->input->post('request_cancel_remark')
                );
                if ($this->request_model->save($request_no, $data)):
                    if ($request[0]->request_status == 'A'): //คืน stock กรณีตัด stock ไปแล้ว
                        $request_item = $this->request_model->get_request_item($request_no)->result();
                        foreach ($request_item as $k => $v) {
                            $this->stock_model->update_stock($v->product_id, $v->branchs_id, $v->quantity, 'increase');
                        }
                    endif;

                endif;
            endif;

            redirect('request', 'refresh');
        endif;
    }

    public function clear() {
        $this->session->unset_userdata('cart_item');
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

    public function deactive($id) {
        $ret = $this->request_model->toggle_status($id);
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

}
