<?php

/**
 * set document type
 * @param string $type type of document
 */
function set_content_type($type = 'application/json') {
    header('Content-Type: ' . $type);
}

/**
 * Read CSV from URL or File
 * @param  string $filename  Filename
 * @param  string $delimiter Delimiter
 * @return array            [description]
 */
function read_csv($filename, $delimiter = ",") {
    $file_data = array();
    $handle = @fopen($filename, "r") or false;
    if ($handle !== FALSE) {
        while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            $file_data[] = $data;
        }
        fclose($handle);
    }
    return $file_data;
}

/**
 * Print Log to the page
 * @param  mixed  $var    Mixed Input
 * @param  boolean $pre    Append <pre> tag
 * @param  boolean $return Return Output
 * @return string/void     Dependent on the $return input
 */
function plog($var, $pre = true, $return = false) {
    $info = print_r($var, true);
    $result = $pre ? "<pre>$info</pre>" : $info;
    if ($return)
        return $result;
    else
        echo $result;
}

/**
 * Log to file
 * @param  string $log Log
 * @return void
 */
function elog($log, $fn = "debug.log") {
    $fp = fopen($fn, "a");
    fputs($fp, "[" . date("d-m-Y h:i:s") . "][Log] $log\r\n");
    fclose($fp);
}

function html_properites($html_prop = array()) {
    $props = array();

    foreach ($html_prop as $key => $prop) {
        array_push($props, "{$key}=\"{$prop}\"");
    }
    return implode(" ", $props);
}

if (!function_exists('html_lang_dropdown')) {

    function html_lang_dropdown( $selected="", $extra="") {
        
        $ci =& get_instance();
        $list = array();
        $html = "";
        $ci->load->model('language_model');
        
        $langs = $ci->language_model->read();
        
//        $html .= "<ul class=\"dropdown-menu pull-right\">";
        $html .= "<ul class=\"dropdown-menu pull-right\">";
        foreach($langs->result() as $lang){
            $active= $ci->session->userdata('language') == $lang->shortname?" class=\"active\" " : "";
            $html .= " <li{$active}><a href=\"". site_url('admin/service/language/'.$lang->shortname)."\"><img src=\"".  asset_url('back/img/blank.gif')."\" class=\"flag flag-{$lang->shortname}\" alt=\"{$lang->fullname}\"> {$lang->fullname}</a></li>";
        }
        $html .= "</ul>";
        
        return $html;
    }

}

if (!function_exists('html_lang_active')) {

    function html_lang_active( $selected=NULL) {
        
        $ci =& get_instance();
        $html = "";
        $ci->load->model('language_model');
        $langs = $ci->language_model->langs();
//        var_dump($ci->session->userdata('language'));
        if(empty($selected)){
            $selected = $ci->session->userdata('language');
            $lang = $langs[$selected];
        }
        
        $html .="<img src=\"".asset_url('back/img/blank.gif')."\" class=\"flag flag-{$selected}\" alt=\"{$lang}\"> <span>{$lang}</span> <i class=\"fa fa-angle-down\"></i> </a>";
        
        return $html;
    }

}


if (!function_exists('smart_current_url')) {

    function smart_current_url() {
        $CI = & get_instance();

        $url = $CI->config->site_url($CI->uri->uri_string());
        return $_SERVER['QUERY_STRING'] ? $url . '?' . $_SERVER['QUERY_STRING'] : $url;
    }

}