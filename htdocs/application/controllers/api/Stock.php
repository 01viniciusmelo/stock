<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

/**
 * Description of Generic
 *
 * @author tae
 * 
 */
class Stock extends REST_Controller {

    private $data = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->lang->load('auth');
        $this->load->model('stock_model');

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
        $search = $this->input->get('search');
        
        $limit = $this->input->get('limit');

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $stock = array();
        //list stock
        $stock_list = $this->stock_model->read()->result();




        $stocks = array();
        $data = array();

        foreach ($stock_list as $item) {
            $stocks['stock_id'] = $item->stock_id;
            $stocks['product_id'] = $item->product_id;
            $stocks['product_name'] = $item->product_name;
            $stocks['branchs_name'] = $item->name;
            $stocks['stock_qty_ori'] = $item->stock_qty_ori;
            $stocks['stock_qty_remaining'] = $item->stock_qty_remaining;
            $stocks['updated_at'] = $item->updated_at;
            $stocks['active'] = anchor('stock/deactive/' . $item->stock_id, ($item->active == 1) ? 'Active' : 'Inactive');
            $stocks['action'] = anchor('stock/edit/' . $item->stock_id, 'Update <i class="fa fa-shopping-basket"></i>');
            array_push($data, $stocks);
        }
        $this->response(array("data" => $data), REST_Controller::HTTP_OK);
    }

}
