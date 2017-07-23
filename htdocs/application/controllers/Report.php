<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Category
 *
 * @author Cheewaphat L.
 */
class Report extends Auth_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        
        $this->load->model('branch_model');
        $this->load->model('report_model');
        
        $this->output->enable_profiler(TRUE);
    }

    public function index() {

    }

    public function branch()
    {
        $fields = array(
            "product_name"  => "Product Name",
            "product_code"  => "Product Code",
            "cat_name"      => "Category",
            "branch_name"   => "Branch",
            "stock_qty_remaining"   => "Qty (remaining)"
        );
             // validate form input
        $this->form_validation->set_rules('branch', 'Branch', 'required');
        
        if ($this->form_validation->run() != FALSE) {         
            
            // option
            $option['is_group_product'] = $this->input->post("is_group_product") == 1;
            $option['is_group_branch'] = $this->input->post("is_group_branch") == 1;
            $option['is_group_category'] = $this->input->post("is_group_category") == 1;
            $option['is_sum_product'] = $this->input->post("is_sum_product") == 1;
            $option['is_sum_price'] = $this->input->post("is_sum_price") == 1;
            $option['is_sum_category'] = $this->input->post("is_sum_category") == 1;  
            
            //no check
            $isUnCheck = TRUE;
            $isUnCheck = $isUnCheck && !$option['is_group_product'];
            $isUnCheck = $isUnCheck && !$option['is_group_branch'];
            $isUnCheck = $isUnCheck && !$option['is_group_category'];
            
            if( ! $isUnCheck ){
                // check product
                if($option['is_group_product']==FALSE){
                    unset($fields['product_name']);
                    unset($fields['product_code']);
                }

                // check branch
                if($option['is_group_branch']==FALSE){
                    unset($fields['branch_name']);
                }

                // check category
                if($option['is_group_category']==FALSE){
                    unset($fields['cat_name']);
                }
            }
            
         }else{
            $_POST['is_group_product'] =1;
         }
         
        $this->data['fields'] = $fields;         
        $this->data['branchs'] = $this->branch_model->read();
        $this->data['csrf'] = $this->_get_csrf_nonce();                            
        $this->data['download_hash'] = md5(time().random_string());
        $this->data['blade'] = "report/report_branch";
        $this->_render_page('template/content', $this->data);
        
    }
    
    public function category()
    {
        
    }
    
    public function transection()
    {
        
    }
    
    public function download($out="excel",$hash)
    {
        $data = $this->session->userdata($hash);
        var_dump($data);
    }
}
