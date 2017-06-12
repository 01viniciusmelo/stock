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
//        if (!$this->ion_auth->logged_in()) {
//            // redirect them to the login page
//            redirect('auth/login', 'refresh');
//        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
//            // redirect them to the home page because they must be an administrator to view this
//            return show_error('You must be an administrator to view this page.');
//        }
        $this->load->model('stock_model');
    }

    public function index()
    {
        $this->data['blade'] = "stock/display";
        $this->_render_page('template/content', $this->data);
    }
    
    public function fileter()
    {
        
    }

    public function display() {
        
    }

}
