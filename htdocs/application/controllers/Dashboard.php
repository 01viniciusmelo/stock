<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Auth_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	// redirect if needed, otherwise display the user list
	public function index()
	{
		$data = array();
		$this->load->view('template/content', $data);

		
	}

	// log the user in
	public function profile	()
	{
	}

}
