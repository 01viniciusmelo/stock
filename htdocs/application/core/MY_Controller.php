<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - MY Controller
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
    
    
     protected function _render_json($data=array(),$code= 200){
        
        $this->output
                ->set_status_header($code)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }
   
}

class Auth_Controller extends CI_Controller {
    
    protected  $userID = NULL;

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
    }
    
    
    private function checkAuth()
    {
        if( !$this->ion_auth->logged_in()){
            redirect('auth/login');
            
            $this->userID = $this->ion_auth->get_user_id();
        }
        
    }
    
    protected function loadConfig(){
        $this->load->model('option_model');
        $configs = $this->option_model
                    ->fields('option_name,option_value,autoload')
                    ->where('autoload','YES')->get();
        

        // foreach($configs as $cfg){
        //     $this->config->set_item($cfg->option_name, $cfg->option_value);
        // }
        
    }
    
    

}

/* End of file MY_Controller.php */
/* Location: /community_auth/core/MY_Controller.php */