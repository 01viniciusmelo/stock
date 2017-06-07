<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * Theme Meta
 */
$config['theme_title'] = "Admin";
$config['theme_description'] = "Demo";
$config['theme_author'] = "cheewaphat@gmail.com";
$config['theme_viewport'] = "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no";
$config['theme_style']="smart-style-1";


/**
 * Table
 */

$config['theme_table'] = array(
    'editbutton' => FALSE,
    'colorbutton' => FALSE,
    'editbutton' => FALSE,
    'togglebutton' => TRUE,
    'deletebutton' => FALSE,
    'fullscreenbutton' => TRUE,
    'custombutton' => FALSE,
    'collapsed' => FALSE,
    'sortable' => FALSE
);


// in assets path
$config['theme_custom_css'] = array(
    'css/my_style.css'
);

// data
$config['datatable'] = array(
    'pageLength'=>50
);

