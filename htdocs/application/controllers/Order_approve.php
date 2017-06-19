<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Category
 *
 * @author Krittkarin.C
 */
class Order_approve extends Auth_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $user = $this->ion_auth->users()->result();
        $this->load->model('product_model');
        $this->load->model('order_model');
        $this->load->model('stock_model');
    }

    public function index() {
        $this->display();
    }

    public function display() {
        $this->data['title'] = 'Sales order approval';


        //Set  Table Search
        $template = array(
            'table_open' => '<table id="order_list" class="order_list table table-striped table-bordered table-hover no-footer" cellspacing="0" width="100%">'
        );
        $this->table->set_template($template);
        $this->table->set_heading(
                'Order No.', '<i class="fa fa-calendar"></i> Order Date', 'Grand Total', 'Reason', 'Branchs', 'By', 'Active', 'Action'
        );
        $this->data['order_list'] = $this->table->generate();


        $this->data['blade'] = "order/order_approval_display";
        $this->_render_page('template/content', $this->data);
    }

    public function approve($order_no, $action) {
        //Save action
        if ($this->order_model->save($order_no, array('order_status' => $action))) {

            if ($action == 'A') { //If Approved
                $order_item = $this->order_model->get_order_item($order_no)->result();
                foreach ($order_item as $k => $v) {
                    $this->stock_model->update_stock($v->product_id, $v->branchs_id, $v->quantity);
                }
            }
        }
        redirect('order_approve', 'refresh');
    }

    public function deactive($id) {
        $ret = $this->order_model->toggle_status($id);
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

}
