<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Auth_Controller {

    public function __construct() {
        parent::__construct();
    }

    // redirect if needed, otherwise display the user list
    public function index() {
        $this->display();
    }

    public function display() {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
            $this->data['users'] = $this->ion_auth->users()->result();
            foreach ($this->data['users'] as $k => $user) {
                $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            }
            
            $this->data['blade'] = "user_display";
            $this->_render_page('template/content', $this->data);
        }
    }

    // log the user in
    public function profile() {
        
    }

}
