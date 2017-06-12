<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stock_Model extends MY_Model {

    public $table = 'branchs'; // you MUST mention the table name
    public $primary_key = 'id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public $delete_cache_on_save = TRUE;

    public function __construct() {
        parent::__construct();
    }
    
    

}
