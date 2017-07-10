<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!function_exists('toHtmlData')) {
    function toHtmlData($dataParams = '', $quetes = ENT_QUOTES,$endcode='UTF-8') {
       return htmlspecialchars(json_encode($dataParams), $quetes, 'UTF-8');
    }
}


if (!function_exists('ci_htmlentities')) {
    function ci_htmlentities($string, $flags=ENT_QUOTES, $encoding='UTF-8') {
        return htmlentities($string, $flags, $encoding);
    }
}



if (!function_exists('make_path_recursive')) {

    function make_path_recursive($dir) {
        if (!is_dir($dir))
            mkdir($dir, 0777, TRUE);
        return TRUE;
    }

}



if (!function_exists('get_client_ip')) {

    // Function to get the client IP address
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        
        else
            $ipaddress = 'UNKNOWN';
        
        return $ipaddress;
    }

}


if (!function_exists('recursiveRemoveDirectory')) {
function recursiveRemoveDirectory($directory)
{
    foreach(glob("{$directory}/*") as $file)
    {
        if(is_dir($file)) { 
            recursiveRemoveDirectory($file);
        } else {
            unlink($file);
        }
    }
    rmdir($directory);
}
}
/* End of file url_helper.php */
/* Location: ./application/helpers/url_helper.php */