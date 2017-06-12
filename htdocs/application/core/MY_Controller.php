<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY Controller
 */
class MY_Controller extends CI_Controller {

    private $data = array();
    private $viewdata = array();

    public function __construct() {
        parent::__construct();

        // init sctipt var
        $this->data['page_script'] = array();
    }

    protected function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    protected function _valid_csrf_nonce() {
        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function _render_page($view, $data = null, $returnhtml = false) {//I think this makes more sense
        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);

        if ($returnhtml)
            return $view_html; //This will return html on 3rd argument being true
    }

    protected function _render_json($data = array(), $code = 200) {

        $this->output
                ->set_status_header($code)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }

}

/**
 * Auth Controller
 */
class Auth_Controller extends CI_Controller {

    protected $userID = NULL;
    protected $data = array();
    protected $viewdata = array();
    protected $tableTemplate = array();
    protected $_dateFormat= '%Y-%m-%d %H:%i:%s';

    /**
     * Class constructor
     */
    public function __construct() {
        parent::__construct();

        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->lang->load('auth');

        $this->checkAuth();
        $this->loadConfig();
        $this->setTableTemplate();
    }

    private function checkAuth() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $this->userID = $this->ion_auth->get_user_id();
    }

    protected function loadConfig() {
        $this->load->model('option_model');

        try {
            $configs = $this->option_model
                            ->fields('option_name,option_value,autoload')
                            ->where('autoload', 'YES')->get_all();

            if (count($configs) > 0) {
                foreach ($configs as $cfg) {
                    $this->config->set_item($cfg->option_name, $cfg->option_value);
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    protected function setTableTemplate() {
        $this->tableTemplate = array(
            'table_open' => '<table class="table table-striped table-bordered table-hover dataTable no-footer" cellspacing="0" width="100%">',
            'thead_open' => '<thead>',
            'thead_close' => '</thead>',
            'heading_row_start' => '<tr>',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'tbody_open' => '<tbody>',
            'tbody_close' => '</tbody>',
            'row_start' => '<tr>',
            'row_end' => '</tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '</tr>',
            'cell_alt_start' => '<td>',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );
    }

    protected function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    protected function _valid_csrf_nonce() {
        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function _render_page($view, $data = null, $returnhtml = false) {//I think this makes more sense
        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);

        if ($returnhtml)
            return $view_html; //This will return html on 3rd argument being true
    }

    protected function _render_json($data = array(), $code = 200) {

        $this->output
                ->set_status_header($code)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }
    protected function pre($data = array()){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit;
    }

}

/* End of file MY_Controller.php */
/* Location: /community_auth/core/MY_Controller.php */