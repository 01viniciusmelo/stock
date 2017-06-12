<?php defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Description of Category
 *
 * @author Cheewaphat L.
 */
class Company extends Auth_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->_render_page('template/content', $this->data);
    }

    

}
