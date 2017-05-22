<?php

if (!function_exists('getGoogleMapInfo')) {

    function getGoogleMapInfo() {

        $ci = & get_instance();
        $lang = $ci->session->userdata('language');
        $ci->load->model('map_model');
        $mapInfo = $ci->map_model->read(array('lang_short' => $lang));
        
        if($mapInfo->num_rows() == 0){
                return NULL;
        }

        return $mapInfo->row(0);
    }

}

if (!function_exists('get_image_info')) {

    function get_image_info($imgID = NULL) {
        
        $ci = & get_instance();
        $q = $ci->db->get_where('images_info', array( 'image_id' => $imgID , 'lang_short'=>$ci->session->userdata('language')) , 1);
        
        if($q->num_rows() > 0){
            return $q->row();
        }
        
        return FALSE;
    }

}


if (!function_exists('get_setting_share')) {

    function get_setting_share() {
        
        $ci = & get_instance();
        $q = $ci->db->get_where('settings', array( 'type' => 'share'));
        
        if($q->num_rows() > 0){
            return $q;
        }
        
        return NULL;
    }

}

if (!function_exists('carousel_page')) {

    function carousel_page($key = NULL) {
        $ci = & get_instance();
        $ci->load->model('slider_Model');
        $r = $ci->slider_Model->readLike($key);
        $html = "";
        if ($r->num_rows() > 0) {
            $html .= '<div class="carousel-inner" role="listbox">';
            foreach ($r->result() as $row) {

                $html .= '<div class="item image-bg" data-image-bg="' . asset_url($row->full_path) . '">';
            }
            $html .= '</div>';
        }
        return $html;
    }

}
