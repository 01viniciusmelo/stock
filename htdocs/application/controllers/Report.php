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
    }

    public function index() {

    }

    public function branch()
    {
             // validate form input
        $this->form_validation->set_rules('branch', 'Branch', 'required');
        
        if ($this->form_validation->run() == FALSE) {
         
         }else{
             $branch = $this->input->post('branch');
             $this->data['reportData']    = $this->report_model->productRemainQtySum($branch);

             
         }
         
        $this->data['branchs'] = $this->branch_model->read();
        $this->data['csrf'] = $this->_get_csrf_nonce();                            
        $this->data['blade'] = "report/report_branch";
        $this->_render_page('template/content', $this->data);
        
    }
    
    public function category()
    {
        
    }
    
    public function transection()
    {
        
    }
}
