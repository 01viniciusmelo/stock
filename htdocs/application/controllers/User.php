<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {


	public function index()
	{
		$this->load->view('template/login');
	}

    public function login()
    {
        if( $this->require_role('admin') )
		{
			echo $this->load->view('examples/page_header', '', TRUE);

			echo '<p>You are logged in!</p>';

			echo $this->load->view('examples/page_footer', '', TRUE);
		}
    }
}
