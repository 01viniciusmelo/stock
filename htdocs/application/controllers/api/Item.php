<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

/**
 * Description of Generic
 *
 * @author tae
 * 
 */
class Item extends REST_Controller {

    private $data = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->lang->load('auth');
        $this->load->model('product_model');

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

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $items =array();
        //list item
        $items_list = $this->product_model->get($item_search)->result();




        $items = array();
        $data = array();

        foreach ($items_list as $item) {
            $items['product_id'] = $item->product_id;
            $items['product_name'] = $item->product_name;
            $items['product_price_selling'] = $item->product_price_selling;
            $items['action'] = "<a class='btn btn-info btn-sm' href='javascript:add_cart({$item->product_id},1);'><i class='fa-fw fa fa-shopping-cart'></i> Add</a>";
            array_push($data, $items);
        }
        $this->response(array("data" => $data), REST_Controller::HTTP_OK);
    }

    public function cart_get() {

        $cart_item = array();
        $items = array();
        $newitem = array();

        $n_sub_total = 0; //sub total

        if (!is_null($this->session->userdata('cart_item'))):
            foreach ($this->session->userdata('cart_item') as $k => $v):
                array_push($cart_item, $v);
                $n_sub_total += $v['n_amount'];
            endforeach;
        endif;

        if ($this->input->get('product_id') && !is_null($this->input->get('product_id'))) :
            $quantity = $this->input->get('quantity');


            //Check exist item
            foreach ($cart_item as $kk => $vv):
                if($this->input->get('product_id') == $vv['product_id']):
                    $quantity += $vv['n_quantity'];
                    unset($cart_item[$kk]);
                endif;
            endforeach;



            if ($quantity > 0):
                $items = $this->product_model->search($this->input->get('product_id'))->result();
                if (!is_null(($items) && count($items) == 1)) {

                    //Set New Item
                    $amount = $quantity * $items[0]->product_price_selling;
                    $n_sub_total += $amount;

                    $newitem['product_id'] = $items[0]->product_id;
                    $newitem['product_name'] = $items[0]->product_name;
                    $newitem['quantity'] = "<input type='number' product_id='{$items[0]->product_id}' class='quantity' value='{$quantity}'\><input type='hidden' class='quantity_{$items[0]->product_id}_p' value='{$quantity}'\>";
                    $newitem['n_quantity'] = $quantity;
                    $newitem['product_price_selling'] = $items[0]->product_price_selling;
                    $newitem['amount'] = "<input type='number' class='amount' value='{$amount}'\ readonly='readonly'>";
                    $newitem['n_amount'] = $amount;
                    $newitem['action'] = "<a class='btn btn-info btn-sm' href='javascript:add_cart({$items[0]->product_id},1);'><i class='fa-fw fa  fa-arrow-up'></i></a> "
                            . "<a class='btn btn-warning btn-sm' href='javascript:add_cart({$items[0]->product_id},-1);'><i class='fa-fw fa  fa-arrow-down'></i></a> ";

                    array_push($cart_item, $newitem);
                } else {
                    $this->response($cart_item, REST_Controller::HTTP_NOT_ACCEPTABLE);
                }
            endif;

        endif;

        $this->session->set_userdata('cart_item', $cart_item);
        $this->response(array("data" => $cart_item, "sub_total" => $n_sub_total), REST_Controller::HTTP_OK);
    }

}
