<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Category
 *
 * @author Cheewaphat L.
 */
class Transfer extends Auth_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();

        $this->load->model('product_model');
        $this->load->model('order_model');
        $this->load->model('branch_model');
        $this->load->model('stock_model');

//        $this->output->enable_profiler(TRUE);
    }

    public function index() {
        $this->data['title'] = 'All Transfer request';


        //Set  Table Search
        $template = array(
            'table_open' => '<table id="transfer_list" class="transfer_list table table-striped table-bordered table-hover no-footer" cellspacing="0" width="100%">'
        );
        $this->table->set_template($template);
        $this->table->set_heading(
                'Transfer No.', '<i class="fa fa-calendar"></i> Transfer Date', 'Transfer Amount', 'Reason', 'From', 'To', 'Created By', 'Transfer Status', 'Active', 'Action'
        );
        $this->data['transfer_list'] = $this->table->generate();


        $this->data['blade'] = "transfer/transfer_display";
        $this->_render_page('template/content', $this->data);
    }

    public function create_transfer($transfer_id = null) {
        $this->data['title'] = 'All Product';

        // validate form input
        $this->form_validation->set_rules('order_no', 'Order No', 'required');
        $this->form_validation->set_rules('order_remark', 'Remark', 'required');
        if ($this->form_validation->run() == FALSE) :

            $this->data['action_type'] = 'TR'; //TR= Transfer
            $this->data['order_no'] = $this->gen_id($this->data['action_type'], null);
            //Set  Table Search
            $template = array(
                'table_open' => '<table id="search_item" class=" search_item table table-striped table-bordered table-hover no-footer" cellspacing="0" width="100%">'
            );
            $this->table->set_template($template);
            $this->table->set_heading('Name', 'Sale Price', 'Action');
            $this->data['search_item'] = $this->table->generate();

            //Set  Table Cart
            $template = array(
                'table_open' => '<table id="cart_item" class="cart_item table table-striped table-bordered table-hover no-footer" cellspacing="0" width="100%">'
            );
            $this->table->set_template($template);
            $this->table->set_heading('Name', 'Sale Price', 'Qty', 'Total', 'Action');
            $this->data['cart_item'] = $this->table->generate();

            $this->data['branch'] = array();
            $branch = $this->branch_model->read();
            foreach ($branch as $k => $v):
                $this->data['branch'][$v->id] = $v->name;
            endforeach;



            $this->data['order']['discount'] = $this->input->post('discount');
            $this->data['order']['tax'] = $this->input->post('tax');
            $this->data['order']['order_ship_name'] = $this->input->post('order_ship_name');
            $this->data['order']['order_ship_address'] = $this->input->post('order_ship_address');
            $this->data['order']['order_billing_name'] = $this->input->post('order_billing_name');
            $this->data['order']['order_billing_address'] = $this->input->post('order_billing_address');

            $this->data['blade'] = "order/order_form";
            $this->_render_page('template/content', $this->data);

        else:


            $save_data_order = array(
                'order_no' => $this->input->post('order_no'),
                'order_remark' => $this->input->post('order_remark'),
                'order_type' => 'TR', //OD:Order, TR:Transfer
                'active' => 1,
                'order_subtotal' => $this->input->post('sub_total'),
                'order_tax' => $this->input->post('tax'),
                'order_discount' => $this->input->post('discount'),
                'order_status' => 'W', //Wait for Approve
                'order_total' => $this->input->post('total'),
                'order_ship_name' => $this->input->post('order_ship_name'),
                'order_ship_address' => $this->input->post('order_ship_address'),
                'order_billing_name' => $this->input->post('order_billing_name'),
                'order_billing_address' => $this->input->post('order_billing_address'),
                'branchs_id' => $this->_branchs['branch_id'], //user branchs_id
                'branchs_id_to' => $this->input->post('branchs_id_to'),
                'created_by' => $this->ion_auth->users()->result()[0]->id,
                'created_at' => mdate($this->_dateFormat, now()),
                'updated_by' => $this->ion_auth->users()->result()[0]->id,
                'updated_at' => mdate($this->_dateFormat, now())
            );
            if ($this->order_model->insert($save_data_order)):
                $save_data_order_item = array();
                foreach ($this->session->userdata('cart_item') as $k => $v):
                    $item = array();
                    $item['order_no'] = $this->input->post('order_no');
                    $item['product_id'] = $v['product_id'];
                    $item['unit_price'] = $v['product_price_selling'];
                    $item['quantity'] = $v['n_quantity'];
                    $item['amount'] = $v['n_amount'];
                    array_push($save_data_order_item, $item);
                endforeach;
                if ($this->order_model->insert_item($save_data_order_item)):
                    $this->session->unset_userdata('cart_item');
                    redirect("transfer", 'refresh');
                endif;
            endif;

        endif;
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
        $this->data['blade'] = "transfer/transfer_view_detail";
        $this->_render_page('template/content', $this->data);
    }

    public function clear() {
        $this->session->unset_userdata('cart_item');
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

    public function deactive($id) {
        $ret = $this->order_model->toggle_status($id);
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

    public function add($productID = NULL, $branchID = NULL) {
        // validate form input
        $this->form_validation->set_rules('id', 'Product id', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->data['id'] = $this->gen_id("TF");
            $this->data['regis_date'] = date('Y-m-d');
            $this->data['branch_from'] = $branchID;
            $this->data['branch_to'] = NULL;

            // product
            $this->data['products'] = $this->stock_model->readProduct($branchID, $productID);

            // branch
            $this->data['branchs'] = array();
            foreach ($this->branch_model->read() as $k => $v) {
                $this->data['branchs'][$v->id] = $v->name;
            }

            $this->data['blade'] = "transfer/transfer_add";
            $this->_render_page('template/content', $this->data);
        } else {
            $data = array(
                "trans_no" => $this->input->post('id'),
                "branch_from" => $this->input->post('branch_from'),
                "branch_to" => $this->input->post('branch_to'),
                "product_id" => $this->input->post('product_id'),
                "regis_date" => $this->input->post('regis_date'),
                "quantity" => $this->input->post('quantity'),
                "remark" => $this->input->post('remark'),
                "status" => Transfer::STATUS_TRANSFER_WAIT
            );

            $this->stock_model->createTransferStock($data);

            redirect('transfer/job/' . $this->input->post('id'));
        }
    }

    public function cancel($order_no) {
        $this->load->model('stock_model');
        $this->form_validation->set_rules('order_cancel_remark', 'Cancel Remark', 'required');
        if ($this->form_validation->run() == FALSE) :
            $this->data['title'] = 'Cancel order : ' . $order_no;

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
            $this->data['order_item_list'] = $this->table->generate();


            $this->data['order_no'] = $order_no;
            $this->data['blade'] = "transfer/transfer_cancel_form";
            $this->_render_page('template/content', $this->data);

        else:
            $order = $this->order_model->get_order($order_no)->result();
            if (count($order) == 1):
                $data = array('order_status' => 'C');
                if ($this->order_model->save($order_no, $data)):
                    if ($order[0]->order_status == 'A'): //คืน stock กรณีตัด stock ไปแล้ว
                        $order_item = $this->order_model->get_order_item($order_no)->result();
                        foreach ($order_item as $k => $v) {
                            $this->stock_model->update_stock($v->product_id, $v->branchs_id, $v->quantity, 'increase');
                            $this->stock_model->update_stock($v->product_id, $v->branchs_id_to, $v->quantity, 'decrease');
                        }
                    endif;

                endif;
            endif;

            redirect('transfer', 'refresh');
        endif;
    }

    public function job($trans_no = NULL) {
        if ($trans_no == NULL) {
            redirect('transfer', 'refresh');
        }

        $this->form_validation->set_rules('trans_no', 'TransNo', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->data['trans_no'] = $trans_no;
            $this->data['transJob'] = $this->stock_model->readTranferJob($trans_no);
            $this->data['blade'] = "transfer/job";
            $this->_render_page('template/content', $this->data);
        } else {
            redirect('transfer/job/' . $this->input->post('trans_no'));
        }
    }

}
