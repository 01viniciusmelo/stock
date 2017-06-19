<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Auth_Controller {

    const FORM_ACTION_ADD = "add";
    const FORM_ACTION_READ = "read";
    const FORM_ACTION_UPDATE = "edit";

    public function __construct() {
        parent::__construct();

        $this->load->model('branch_model');
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

            $this->data['blade'] = "users/user_display";
            $this->_render_page('template/content', $this->data);
        }
    }

    // log the user in
    public function profile() {
        
    }

    // deactivate the user
    public function deactivate($id = NULL) {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();

            $this->data['blade'] = "users/user_deactivate";
            $this->_render_page('template/content', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }

            // redirect them back to the auth page
            redirect('user', 'refresh');
        }
    }

    // create a new user
    public function create() {

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('user/login', 'refresh');
        }

        // validate form input
        $this->form_validation->set_rules('firstName', 'First Name', 'required');
        $this->form_validation->set_rules('lastName', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[confirmPassword]');
        $this->form_validation->set_rules('confirmPassword', 'confirmPassword', 'required');

        if ($this->form_validation->run() == FALSE) {


            $this->data['groups'] = $this->ion_auth->groups()->result_array();
            $this->data['branchs'] = $this->branch_model->read();
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['firstName'] = $this->form_validation->set_value('firstName', $this->input->post('first_name'));
            $this->data['lastName'] = $this->form_validation->set_value('lastName', $this->input->post('last_name'));
            $this->data['email'] = $this->form_validation->set_value('email', $this->input->post('email'));
            $this->data['phone'] = $this->form_validation->set_value('phone', $this->input->post('phone'));
            $this->data['company'] = $this->form_validation->set_value('company', $this->input->post('company'));

            $this->data['blade'] = "users/user_create";
            $this->_render_page('template/content', $this->data);
        } else {

            $email = strtolower($this->input->post('email'));
            $password = $this->input->post('password');
            $group = array($this->input->post('group'));

            $additional_data = array(
                'first_name' => $this->input->post('firstName'),
                'last_name' => $this->input->post('lastName'),
                'company' => $this->input->post('customer'),
                'branch' => $this->input->post('branch'),
                'phone' => $this->input->post('phone'),
            );



            $this->ion_auth->register($email, $password, $email, $additional_data, $group);
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("user", 'refresh');
        }
    }

    // edit a user
    public function editUser($id) {
        $this->data['title'] = $this->lang->line('edit_user_heading');

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $this->form_validation->set_rules('firstName', "First Name", 'required');
        $this->form_validation->set_rules('lastName', "Last Name", 'required');
        $this->form_validation->set_rules('branch', "Branch", 'required');

        if (isset($_POST) && !empty($_POST)) {

            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }

            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE) {

                $data = array(
                    'first_name' => $this->input->post('firstName'),
                    'last_name' => $this->input->post('lastName'),
                    'branch' => $this->input->post('branch'),
                    'phone' => $this->input->post('phone'),
                );

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }



                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }
                    }
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    if ($this->ion_auth->is_admin()) {
                        redirect('user', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    if ($this->ion_auth->is_admin()) {
                        redirect('user', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                }
            }
        }

        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['branchs'] = $this->branch_model->read();
        $this->data['currentGroups'] = $currentGroups;

        $this->data['firstName'] = $this->form_validation->set_value('firstName', $user->first_name);
        $this->data['lastName'] = $this->form_validation->set_value('lastName', $user->first_name);
        $this->data['email'] = $this->form_validation->set_value('email', $user->email);
        $this->data['phone'] = $this->form_validation->set_value('phone', $user->phone);
//        $this->data['company'] = $this->form_validation->set_value('company', $user->company);


        $this->data['blade'] = "users/user_create";
        $this->_render_page('template/content', $this->data);
    }

    // create a new group
    public function create_group() {
        $this->data['title'] = $this->lang->line('create_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth", 'refresh');
            }
        } else {
            // display the create group form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('group_name'),
            );
            $this->data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'value' => $this->form_validation->set_value('description'),
            );

            $this->_render_page('auth/create_group', $this->data);
        }
    }

    // edit a group
    public function edit_group($id) {
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('auth', 'refresh');
        }

        $this->data['title'] = $this->lang->line('edit_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect("auth", 'refresh');
            }
        }

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['group'] = $group;

        $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

        $this->data['group_name'] = array(
            'name' => 'group_name',
            'id' => 'group_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
        );
        $this->data['group_description'] = array(
            'name' => 'group_description',
            'id' => 'group_description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );

        $this->_render_page('auth/edit_group', $this->data);
    }

    public function role() {

//        if ($action == User::FORM_ACTION_READ) {

            if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
                redirect('auth', 'refresh');
            }

            // validate form input
            $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

            if ($this->form_validation->run() == TRUE) {
                $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
                if ($new_group_id) {
                    // check to see if we are creating the group
                    // redirect them back to the admin page
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect("user", 'refresh');
                }
            } else {
                // display the create group form
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                $this->data['group_name'] = $this->form_validation->set_value('group_name');
                $this->data['description'] =  $this->form_validation->set_value('description');
                
                $this->data['blade'] = "users/role_create";
                $this->_render_page('template/content', $this->data);
                //$this->_render_page('auth/create_group', $this->data);
            }
//        }
//
//        if ($action == User::FORM_ACTION_ADD) {
//            
//        }
//
//        if ($action == User::FORM_ACTION_UPDATE) {
//            
//        }
    }

}
