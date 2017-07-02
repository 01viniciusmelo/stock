<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Asset URL
 * 
 * Create a local URL to your assets based on your basepath.
 *
 * @access	public
 * @param   string
 * @return	string
 */
if (!function_exists('asset_url')) {
    function asset_url($uri = '', $group = FALSE) {
        $CI = & get_instance();
        
        if (!$dir = $CI->config->item('assets_path')) {
            $dir = 'assets/';
        }
        
        if ($group) {
            return $CI->config->base_url($dir . $group . '/' . $uri);
        } else {
            return $CI->config->base_url($dir . $uri);
        }
    }
}


/**
 * Asset DIR
 * 
 * Create a local URL to your assets based on your basepath.
 *
 * @access	public
 * @param   string
 * @return	string
 */
if (!function_exists('asset_dir')) {
    function asset_dir($uri = '', $group = FALSE) {
        $CI = & get_instance();
        
        if (!$dir = $CI->config->item('assets_path')) {
            $dir = 'assets'.DIRECTORY_SEPARATOR;
        }
        
        if ($group) {
            return FCPATH.$dir.$group.DIRECTORY_SEPARATOR.$uri;
        } else {
            return FCPATH.$dir.DIRECTORY_SEPARATOR.$uri;
        }
    }
}



/**
 * Temp URL
 * 
 * Create a local URL to your tmps based on your basepath.
 *
 * @access	public
 * @param   string
 * @return	string
 */
if (!function_exists('temp_url')) {
    function temp_url($uri = '', $group = FALSE) {
        $CI = & get_instance();
        
        if (!$dir = $CI->config->item('tmp_path')) {
            $dir = 'temp/';
        }
        
        if ($group) {
            return rtrim($CI->config->base_url($dir . $group . "/" . $uri),"/");
        } else {
            return rtrim($CI->config->base_url($dir . $uri),"/");
        }
    }
}


/**
 * Temp DIR
 * 
 * Create a local URL to your tmps based on your basepath.
 *
 * @access	public
 * @param   string
 * @return	string
 */
if (!function_exists('temp_dir')) {
    function temp_dir($uri = '', $group = FALSE) {
        $CI = & get_instance();
        
        if (!$dir = $CI->config->item('tmp_path')) {
            $dir = 'temp'.DIRECTORY_SEPARATOR;
        }
        
        $dir = rtrim($dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        
        if ($group) {
            return FCPATH.$dir.$group.DIRECTORY_SEPARATOR.$uri;
        } else {
            return FCPATH.$dir.$uri;
        }
    }
}

/**
 * Temp URL
 * 
 * Create a local URL to your tmps based on your basepath.
 *
 * @access	public
 * @param   string
 * @return	string
 */
if (!function_exists('images_product_url')) {
    function images_product_url($uri = '', $group = FALSE) {
        $CI = & get_instance();
        
        if (!$dir = $CI->config->item('images_product_url')) {
            $dir = 'products/images';
        }
        
        if ($group) {
            return rtrim($CI->config->base_url($dir . $group . "/" . $uri),"/");
        } else {
            return rtrim($CI->config->base_url($dir . $uri),"/");
        }
    }
}


/**
 * Temp DIR
 * 
 * Create a local URL to your tmps based on your basepath.
 *
 * @access	public
 * @param   string
 * @return	string
 */
if (!function_exists('images_product_dir')) {
    function images_product_dir($uri = '', $group = FALSE) {
        $CI = & get_instance();
        
        if (!$dir = $CI->config->item('images_product_path')) {
            $dir = 'products'.DIRECTORY_SEPARATOR.'images';
        }
        
        $dir = rtrim($dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        
        if ($group) {
            return FCPATH.$dir.$group.DIRECTORY_SEPARATOR.$uri;
        } else {
            return FCPATH.$dir.$uri;
        }
    }
}

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