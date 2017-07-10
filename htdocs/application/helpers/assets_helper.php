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
