<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Category
 *
 * @author Krittkarin.C
 */
class Transfer_approve extends Auth_Controller {

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
        $this->data['title'] = 'STransfer request approval';


        //Set  Table Search
        $template = array(
            'table_open' => '<table id="transfer_list" class="transfer_list table table-striped table-bordered table-hover no-footer" cellspacing="0" width="100%">'
        );
        $this->table->set_template($template);
        $this->table->set_heading(
                'Transfer No.', '<i class="fa fa-calendar"></i> Transfer Date', 'Transfer Amount', 'Reason', 'From', 'To', 'Created By', 'Transfer Status', 'Action'
        );
        $this->data['transfer_list'] = $this->table->generate();


        $this->data['blade'] = "transfer/transfer_approval_display";
        $this->_render_page('template/content', $this->data);
    }
    
    public function view($order_no) {
        $this->data['title'] = 'View transfer : ' . $order_no;

        $this->data['order'] = $this->order_model->get_order($order_no)->result();
        $order_item = $this->order_model->get_order_item($order_no)->result();

        if (count($order_item) <= 0)
            redirect('order', 'refresh');

        //Set  Table template
        $template = array(
            'table_open' => '<table class="table table-hover" cellspacing="0" width="100%">'
        );
        $this->table->set_template($template);
        $this->table->set_heading('NO.', 'ITEM', 'DESCRIPTION', 'UNIT PRICE', 'QTY', 'TOTAL');
        //list Category
        foreach ($order_item as $k => $v) {
            $this->table->add_row($k + 1, $v->product_name, $v->product_desc, number_format($v->unit_price, 2), number_format($v->quantity, 2), number_format($v->amount, 2));
        }

        $this->table->add_row('SUB TOTAL', '', '', '', '', '<strong>' . number_format($order_item[0]->order_subtotal, 2) . '</strong>');
        $this->table->add_row('DISCOUNT', '', '', '', '', number_format($order_item[0]->order_discount, 2));
        $this->table->add_row('TAX', '', '', '', '', number_format($order_item[0]->order_tax, 2) . '%');
        //$this->table->add_row('<>TOTAL</strong>','','','',  '<strong>'.number_format($order_item[0]->order_total,2).'</strong>' );
        $this->data['order_item_list'] = $this->table->generate();


        $this->data['order_no'] = $order_no;
        $this->data['blade'] = "transfer/transfer_approval_view_detail";
        $this->_render_page('template/content', $this->data);
    }

    public function approve($order_no, $action) {
        //Save action
        if ($this->order_model->save($order_no, array('order_status' => $action))) {

            if ($action == 'A') { //If Approved
                $order_item = $this->order_model->get_order_item($order_no)->result();
                foreach ($order_item as $k => $v) {
                    $this->stock_model->update_stock($v->product_id, $v->branchs_id, $v->quantity); //update old stock
                    $this->stock_model->update_stock($v->product_id, $v->branchs_id_to, $v->quantity,'increase'); //update new stock
                }
            }
        }
        redirect('transfer_approve', 'refresh');
    }

    public function deactive($id) {
        $ret = $this->order_model->toggle_status($id);
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

}
