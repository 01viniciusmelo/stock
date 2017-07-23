<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

/**
 * Description of Generic
 *
 * @author tae
 * 
 */
class Report extends REST_Controller {

    private $data = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->lang->load('auth');
        $this->load->model('datatable/report_model','report_model');

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
    
    /*
     * branch_post
     * for data table
     * 
     */
    public function branch_post()
    {
        $response = array();
        $response['data'] = array();
        
        $strForm = $this->input->post('form');
        parse_str($strForm,$_POST);        
        
        $this->form_validation->set_rules('branch', 'Branch', 'required');
        
        if ($this->form_validation->run() != FALSE) {         
            
            $this->session->set_userdata($this->input->post('download_hash'),$strForm);
            // option
            $option['is_group_product'] = $this->input->post("is_group_product") == 1;
            $option['is_group_branch'] = $this->input->post("is_group_branch") == 1;
            $option['is_group_category'] = $this->input->post("is_group_category") == 1;
            $option['is_sum_product'] = $this->input->post("is_sum_product") == 1;
            $option['is_sum_price'] = $this->input->post("is_sum_price") == 1;
            $option['is_sum_category'] = $this->input->post("is_sum_category") == 1;  
            
            $branch = $this->input->post('branch');
            
            // business model
            $this->report_model->setColumns($this->post('columns'));            
            $this->report_model->setOrder($this->post('order'));
            $reportData  = $this->report_model->productRemainQtySum( $this->post('branch') , $option,$this->post('start'), $this->post('length') );
            
            $response['draw']   = $this->post('draw') ; //page                    
            $response["recordsTotal"]= $reportData->getRecordsTotal();
            $response["recordsFiltered"]=  $reportData->getRecordsFiltered();;
            $response['data']    = $reportData->getData();
            $response['option']   = $option;
            $response['download_hash'] = $this->post('download_hash');
            
         }
        
        $this->response($response, REST_Controller::HTTP_OK);
        
    }

}
