<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

/**
 * Description of Generic
 *
 * @author tae
 * 
 */
class Order_approve extends REST_Controller {

    private $data = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->lang->load('auth');
        $this->load->model('product_model');
        $this->load->model('order_model');

        $this->checkAuth();
    }

    private function checkAuth() {

        if (!$this->ion_auth->logged_in()) {
            $data = array(
                'status' => 200,
                'description_en' => 'Success',
                'description_th' => 'สำเร็จ',
                "data" => site_url()
            );

            $this->response($data, REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function index_get() {


        $generic = array(
            'status' => 200,
            'description_en' => 'Success',
            'description_th' => 'สำเร็จ',
            "data" => site_url()
        );

        $this->response($generic, 200);
    }

    public function all_get() {
        // set the flash data error message if there is one
        $item_search = $this->input->get('search');
        
        //print_r($item_search);


        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //list item
        $this->data['order'] = $this->order_model->search($item_search['value'],true,true)->result();


        $items = array();
        $data = array();

        foreach ($this->data['order'] as $item) {
            $items['order_no'] = $item->order_no;
            $items['order_subtotal'] = $item->order_subtotal;
            $items['order_discount'] = $item->order_discount;
            $items['order_tax'] = $item->order_tax;
            $items['order_total'] = $item->order_total;
            $items['order_remark'] = $item->order_remark;
            $items['order_status'] = $item->order_status;
            $items['reason_title'] = $item->reason_title;
            $items['branchs_name'] = $item->branchs_name;
            $items['created_by'] = $item->created_by;
            $items['created_at'] = $item->created_at;
            $items['active'] = anchor('order/deactive/' . $item->order_no, ($item->active == 1) ? 'Active' : 'Inactive');
            $items['action'] = anchor('order/view/' . $item->order_no, '<i class="fa fa-info-circle"></i> View','class="btn btn-sm btn-info"')." "
                    . "".anchor('order_approve/approve/' . $item->order_no.'/A', '<i class="fa fa-check-circle-o"></i> Approve','class="btn btn-sm btn-success"');
            
            array_push($data, $items);
        }
        $this->response(array("data" => $data), REST_Controller::HTTP_OK);
    }

}
