<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product_model
 *
 * @author Krittkarin.C
 */
class Product_model extends MY_Model {

    public $table = 'products'; // you MUST mention the table name
    public $primary_key = 'product_id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    public $delete_cache_on_save = TRUE;

    public function __construct() {
        parent::__construct();
        
        $this->user = $this->ion_auth->user()->row();
    }

    public function search($product_id = NULL, $search = NULL) {
        $where = " 1=1 ";
        if (!is_null($product_id)) {
            $where .= " AND `{$this->table}`.`{$this->primary_key}` = {$product_id} ";
        }


        if (!is_null($search)) {
            $where .= " AND (`{$this->table}`.`product_code` like '%{$search}%' "
                    . "or `{$this->table}`.`product_name` like '%{$search}%' ) "
                    . "and `{$this->table}`.`active` = 1";
        }

        $data = $this->db->query(
                " SELECT `{$this->table}`.*,`category`.`cat_desc` "
                . ",branchs.name as branch_name ,branchs.id as branch_id"
                . " FROM `{$this->table}` "                
                . " left join `category` on  `{$this->table}`.`cat_id` = `category`.`cat_id` and `category`.`active` = 1 "
                . " left join `branchs` on `products`.product_branch_origin = `branchs`.id"
                . " where {$where} "
        );
        return $data;
    }

    public function get($product_code = 'X', $branchs = 1, $is_active = true) {
        //$branchs = 1; //Change Branchs by User account
        $this->db->from($this->table);
        $this->db->join('category', "category.cat_id = {$this->table}.cat_id and category.active=1");
        $this->db->join('stock', "stock.product_id = {$this->table}.product_id and stock.active=1 and stock.branchs_id = {$branchs}");
        $this->db->where('product_code', $product_code);

        if ($is_active == true)
            $this->db->where("{$this->table}.active", true);

        $data = $this->db->get();
        return $data;
    }

    public function read($where = array(), $limit = NULL, $offet = 0) {
        $criteria = array('active' => MY_Model::FLAG_DATA_ACTIVE);

        if (!empty($where)) {
            foreach ($where as $f => $v) {
                $criteria[$f] = $v;
            }
        }

        $q = $this->order_by('product_name', 'ASC');

        if (!is_null($limit)) {
            $q->limit($limit, $offet);
        }

        $data = $q->get_all($criteria);
        //$data = $q->set_cache("customer_read", 500)->get_all($criteria);

        return $data;
    }

    public function addStock($data = null) {
        $created_at = date($this->timestamps_format);
        $created_by = $this->user->id;
        
        $this->db->trans_start();
        // product
        $this->db->insert("products", $data);
        $producID = $this->db->insert_id();

        //stock
        $this->db->insert("stock", array(
            "branchs_id" => $data['product_branch_origin'],
            "product_id" => $producID,
            "stock_qty_ori" => $data['quantity'],
            "stock_qty_remaining" => $data['quantity'],
            "created_by" => empty($data['created_by'])? 0 : $created_by,
            "created_at" => empty($data['created_at'])? 0 : $created_at,
            "updated_by" => empty($data['updated_by'])? 0 : $created_by,
            "updated_at" => empty($data['active'])? 0 : $created_at,
            "active" => empty($data['active'])? 0 : MY_Model::FLAG_DATA_ACTIVE
        ));
        $this->db->trans_complete();

        return $producID;
    }

    public function insert($data = null) {
        if ($this->db->insert($this->table, $data))
            return true;
        return false;
    }

    public function save($product_id = null, $data = null) {
        $this->db->where("{$this->primary_key}", $product_id);
        if ($this->db->update($this->table, $data))
            return true;
        return false;
    }

    public function toggle_status($product_id) {
        $q = "UPDATE `{$this->table}` SET `active` = NOT `active` where `{$this->primary_key}`={$product_id} ";
        if ($this->db->query($q))
            return true;
        return false;
    }
    
    public function getImages($productID=NULL)
    {        
        $url = images_product_url();
        $sql = " SELECT * 
                ,CONCAT('{$url}','/',image_path) as url  
                ,CONCAT('". site_url('api/product/image_action/delete')."','/') as delete_url
                FROM product_images WHERE product_id = ?";
        
        $q = $this->db->query($sql,$productID);
        $data = array();
        foreach( $q->result() as $row){
            //$d = new stdClass();
            $d = $row;
            $d->image_data = json_decode($row->image_data);
            array_push($data, $d);
        }
        return $data;
        
    }

    public function uploadImages($filename='userFiles',$product_id=NULL) {
        $tmpfilename = sprintf("FILEUPLOAD-%S", random_string('alnum', 8));
        $data = array();
        if ( !empty($_FILES[$filename]['name']) &&! empty( $product_id )  ){
            $filesCount = count($_FILES[$filename]['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES[$tmpfilename]['name'] = $_FILES[$filename]['name'][$i];
                $_FILES[$tmpfilename]['type'] = $_FILES[$filename]['type'][$i];
                $_FILES[$tmpfilename]['tmp_name'] = $_FILES[$filename]['tmp_name'][$i];
                $_FILES[$tmpfilename]['error'] = $_FILES[$filename]['error'][$i];
                $_FILES[$tmpfilename]['size'] = $_FILES[$filename]['size'][$i];

                $uploadPath = images_product_dir().DIRECTORY_SEPARATOR.$product_id;
                make_path_recursive($uploadPath);
                
                $config['upload_path'] = $uploadPath;
                //$config['file_name']    = "PROD-";                
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload($tmpfilename)) {
                    $fileData = $this->upload->data();
                    
                    $uploadData[$i]['product_id'] = $product_id;                    
                    $uploadData[$i]['image_path'] = str_replace(str_replace("\\","/",images_product_dir()),  "",$fileData['full_path']);                   
                    $uploadData[$i]['image_name'] = $fileData['raw_name'];                    
                    $uploadData[$i]['image_data'] = json_encode($fileData);    
                    $uploadData[$i]['active'] = 1;    
                    $uploadData[$i]['created_at'] = date($this->timestamps_format);    
                    $uploadData[$i]['created_by'] = $this->session->userdata('user_id');
                }
            }
            

            if (!empty($uploadData)) {                                        
                $this->db->insert_batch('product_images', $uploadData);                 
            }
            
            return true;
        }
        
        

    }
    
    
    public function removeImage($imageID)
    {
        // get remove file
        $query = $this->db->query("SELECT * FROM product_images WHERE image_id = ? LIMIT 1;",$imageID);
        $row = $query->row(0);

        $file = str_replace("/",DIRECTORY_SEPARATOR, images_product_dir($row->image_path));    
        if(file_exists($file)){
            unlink($file);
        }        
        $this->db->delete('product_images', array('image_id' => $imageID));
    }

}
