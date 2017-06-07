<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

/**
 * Description of Generic
 *
 * @author joe
 * 
 */
class User extends REST_Controller {

    private $data = array();

    public function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->lang->load('auth');

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
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //list the users
        $this->data['users'] = $this->ion_auth->users()->result();
        foreach ($this->data['users'] as $k => $user) {
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }
        
        // prepare date
        $users = array();
        $data = array();
//        for($i=0;$i<10000;$i++):
        foreach ($this->data['users'] as $user){
            $users['first_name']=$user->first_name;
            $users['last_name']=$user->last_name;
            $users['email']=$user->email;
//            $users['groups']=$user->groups;
            $users['branch']=$user->branch;
            $users['status']=($user->active) ? anchor("user/deactivate/" . $user->id, lang('index_active_link')) : anchor("user/activate/" . $user->id, lang('index_inactive_link'));
            $users['action']=anchor("user/edit/" . $user->id, 'Edit');
            
            $tmp = array();
            foreach($user->groups as $group){
                array_push($tmp, $group->name);
            }
            $users['groups'] = implode(", ", $tmp);
            
            array_push($data, $users);
        }
//        endfor;

        $this->response(array("data"=>$data), REST_Controller::HTTP_OK);
    }

}
