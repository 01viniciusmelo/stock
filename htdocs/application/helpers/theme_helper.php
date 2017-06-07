<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Asset URL
 * 
 * Create a local URL to your assets based on your basepath.
 *
 * @access	public
 * @param   string
 * @return	string
 */
if (!function_exists('nav_active_link')) {

    function nav_active_link($uri = '', $title = "", $icon = NULL,$control=NULL) {
       
        $CI = & get_instance();
        $active = (uri_string() == $uri || $CI->uri->rsegment(1) == $control) ? "class=\"active\" " : "";
        $uri = site_url($uri);
        
        if (!is_null($icon)) {

        $link = "<li data-rsegmen=\"".$CI->uri->segment(1)."\" {$active}><a href=\"{$uri}\" title=\"{$title}\"><i class=\"fa fa-lg fa-fw {$icon}\"> </i> "
                    . "<span class=\"menu-item-parent\">{$title}</span></a></li>";
        } else {
            $link = "<li {$active}><a href=\"{$uri}\">{$title}</a></li>";
        }


        return $link;
    }

}


if (!function_exists('jarviswidget_table_config')) {

    function jarviswidget_table_config() {

        $conf = config_item('theme_table');
        $dataConfs=array();
        
        if(is_array($conf)){
            
            foreach($conf as $cfg=>$val){
                if ( ! $val )
                    array_push($dataConfs, "data-widget-{$cfg}=".($val ? "true":"false")."");
            }
        }
        
        return implode(" ", $dataConfs);
    }

}


if (!function_exists('data_table_config')) {

    function data_table_config($key = NULL) {

        $conf = config_item('datatable');
        return $conf[$key];
    }

}



if (!function_exists('format_date_time')) {

    function format_date_time($date,$format="d-m-Y") {
        $conf = config_item('date_format');
        return date($conf,strtotime($date));
    }

}


/* End of file url_helper.php */
/* Location: ./application/helpers/url_helper.php */