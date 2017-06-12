<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Auth_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
            $data = array();

            $this->data['blade'] = "dashboard/main";
            $this->_render_page('template/chart', $this->data);
	}

	// log the user in
	public function profile	()
	{
	}

}
