<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

	}

	// redirect if needed, otherwise display the user list
	public function index()
	{

		$this->load->view('static/page_under_construction');
	}


}
