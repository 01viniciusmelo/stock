<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category
 *
 * @author Krittkarin.C
 */
class Stock extends Auth_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('stock_model');
    }

    public function index()
    {
        $this->data['blade'] = "stock/display";
        $this->_render_page('template/content', $this->data);
    }
    
    public function filter()
    {
        $data = array('data'=>array());
        $this->_render_json($data, 200);
        
    }

    public function display() {
        
    }
    
    public function transaction()
    {
        $this->data['blade'] = "stock/transaction";
        $this->_render_page('template/content', $this->data);
    }

}
