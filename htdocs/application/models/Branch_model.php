<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Branch_Model extends MY_Model{
    
    
    public $table = 'branchs'; // you MUST mention the table name
    public $primary_key = 'id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public $delete_cache_on_save = TRUE;
    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function search($key = NULL)
    {
        $where = " `{$this->table}`.`active` IN('Y')
                    AND ( `{$this->table}`.`name` LIKE '%{$key}%' ESCAPE '!'
                    OR  `{$this->table}`.`email` LIKE '%{$key}%' ESCAPE '!'
                    OR  `{$this->table}`.`address` LIKE '%{$key}%' ESCAPE '!'
                    OR  `{$this->table}`.`phone` LIKE '%{$key}%' ESCAPE '!'  ) ";
                                
        if(is_null($key)){
            $where=" `{$this->table}`.`active` IN('Y') ";
        }
                                
        $data = $this->db->query(" SELECT * FROM `{$this->table}` WHERE {$where}");
                                
        return $data;
    }
    
    public function read($where=array(),$limit = NULL,$offet = 0)
    {
        $criteria = array('active'=>'Y');
        
        if(!empty($where)){
            foreach($where as $f=>$v){
                $criteria[$f] = $v;
            }
        }
        
        $q = $this->order_by('name','ASC');
        
        if( ! is_null($limit ) ){
            $q->limit($limit,$offet);
        }
        
        
        $data = $q->set_cache("customer_read",500)->get_all($criteria);
        
        return $data;
    }
 
    public function delete($id = NULL) {
        // update status
        if(!is_null($id)){
            $where['active']='N';
            $where['id']=$id;
            $this->update($where,'id');
            return true;
        }
        return false;
    }
}
