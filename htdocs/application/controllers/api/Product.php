<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

/**
 * Description of Generic
 *
 * @author joe
 * 
 */
class Product extends REST_Controller {

    private $data = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->lang->load('auth');

        $this->checkAuth();
        
        //load  lib
        $this->load->model('product_model');
        $this->load->model('category_model');
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

        
        $products = $this->product_model->search()->result();
        // prepare date
        
        $data = array();
        foreach ($products as $product){
            $row = new stdClass();
            $row = $product;
            $row->status = anchor('product/deactive/' . $product->product_id, ($product->active == 1) ? 'Active' : 'Inactive');
            $row->action = anchor('product/edit/' . $product->product_id, '<i class="fa-fw fa fa-edit"></i> Edit');
            array_push($data, $row);
        }
        

        $this->response(array("data"=>$data), REST_Controller::HTTP_OK);
    }

}
