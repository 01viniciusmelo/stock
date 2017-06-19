<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('dropdownCustomer')) {

    function dropdownCustomer($data, $selected, $extra, $defualt = FALSE) {

        $ci = get_instance();
        $where = array();
        $ci->load->model('customer_model');

        $where['active'] = 'Y';
        if ( $ci->ion_auth->in_group('customer')){
            $where['id'] = $ci->ion_auth->user( $ci->session->userdata('user_id'))->row(0)->company;
        }
        
        $options = $ci->customer_model
                ->where($where)
                ->as_dropdown('sitename')
                ->get_all();
        if ($defualt) {
            $tmp = array('0' => 'ALL');
            foreach ($options as $key => $opt) {
                $tmp[$key] = $opt;
            }
            $options = $tmp;
        }
        return form_dropdown($data, $options, $selected, $extra);
    }

}

if (!function_exists('dropdownItem')) {

    function dropdownItem($data, $selected, $extra, $defualt = FALSE) {

        $ci = get_instance();

        $ci->load->model('item_model');

        $options = $ci->customer_model
                ->where('item_active', 'Y')
                ->as_dropdown('item_desc')
                ->get_all();
        if ($defualt) {
            $tmp = array('0' => 'ALL');
            foreach ($options as $key => $opt) {
                $tmp[$key] = $opt;
            }
            $options = $tmp;
        }
        return form_dropdown($data, $options, $selected, $extra);
    }

}