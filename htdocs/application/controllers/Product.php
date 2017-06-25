<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Product
 *
 * @author Krittkarin.C
 */
class Product extends Auth_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('branch_model');

        // excel adapter
        // include APPPATH . 'libraries/PhpSpreadsheet/src/Bootstrap.php';
    }

    public function index() {
        $this->display();
    }

    public function display() {
        $this->data['title'] = 'All Product';

        //Set Product Table
//        $this->table->set_template($this->tableTemplate);
//        $this->table->set_heading('ID', 'Product Name','Product No.', 'Description', 'Purchasing Price', 'Sale Price', 'Category', 'Status', 'Action');
//
//
//        $product = $this->product_model->search()->result();
//        //list Product
//        foreach ($product as $k => $v) {
//            $this->table->add_row(
//                    $v->product_id, $v->product_name,$v->product_number, $v->product_desc, $v->product_price_purchasing, $v->product_price_selling, $v->cat_desc, anchor('product/deactive/' . $v->product_id, ($v->active == 1) ? 'Active' : 'Inactive'), anchor('product/edit/' . $v->product_id, '<i class="fa-fw fa fa-edit"></i> Edit')
//            );
//        }
//        $this->data['table_data'] = $this->table->generate();

        $this->data['blade'] = "product/product_display";
        $this->_render_page('template/content', $this->data);
    }

    public function add() {
        $this->data['title'] = 'Add new Product';
        $product = new stdClass();
        // validate form input
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            
            foreach ($this->input->post() as $k => $v) {
                $product->$k = $v;
            }
            
            $this->data['branchs'] = array();
            foreach ($this->branch_model->read() as $k => $v) {
                $this->data['branchs'][$v->id] = $v->name;
            }

            $this->data['category'] = array();
            foreach ($this->category_model->search(null, true)->result() as $k => $v) {
                $this->data['category'][$v->cat_id] = $v->cat_name;
            }

            $this->data['product'] = $product;
            $this->data['blade'] = "product/product_form";
            $this->_render_page('template/content', $this->data);
        } else {
            $save_data = array(
                'product_name' => $this->input->post('product_name'),
                'product_desc' => $this->input->post('product_desc'),
                'product_code' => $this->input->post('product_code'),
                'cat_id' => $this->input->post('cat_id'),
                'active' => $this->input->post('active'),
                'unit' => $this->input->post('unit'),
                'product_branch_origin' => $this->input->post('product_branch_origin'),
                'product_price_selling' => $this->input->post('product_price_selling'),
                'product_price_purchasing' => $this->input->post('product_price_purchasing'),
                'quantity' => $this->input->post('quantity'),
                'created_by' => $this->ion_auth->users()->result()[0]->id,
                'updated_by' => $this->ion_auth->users()->result()[0]->id
            );
            $ret = $this->product_model->addStock($save_data);
            redirect("product", 'refresh');
        }
    }

    public function edit($product_id) {
        $this->data['title'] = 'Edit Product';
        $this->data['category'] = array();
        $this->data['branchs'] = array();
        
        $product = $this->product_model->search($product_id);
        $categories = $this->category_model->getCategoryNames();
        foreach ($this->branch_model->read() as $k => $v) {
            $this->data['branchs'][$v->id] = $v->name;
        }
            
        foreach($categories as $row){
            $this->data['category'][$row->cat_id] = $row->cat_name;
        }
        
        if (isset($product) && count($product->result()) > 0) {
            // validate form input
            $this->form_validation->set_rules('product_name', 'Product Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                foreach ($this->input->post() as $k => $v) {
                    $product->$k = $v;
                }
                $this->data['product'] = $product->result()[0];
                $this->data['blade'] = "product/product_form";
                $this->_render_page('template/content', $this->data);
            } else {
                $save_data = array(
                    'product_name' => $this->input->post('product_name'),
                    'product_desc' => $this->input->post('product_desc'),
                    'unit' => $this->input->post('unit'),
                    'active' => $this->input->post('active'),
                    'updated_by' => $this->ion_auth->users()->result()[0]->id,
                    'updated_at' => mdate($this->_dateFormat, now())
                );

                $ret = $this->product_model->save($product_id, $save_data);
                redirect("product", 'refresh');
            }
        } else
            redirect("product", 'refresh');
    }

    public function deactive($product_id) {
        $ret = $this->product_model->toggle_status($product_id);
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

}
