<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(!function_exists('fancy_gallery')){
    function fancy_gallery($images=array(),$attr=array('class'=>'owl-carousel')){
        
    }
}

if(!function_exists('owl_carousel')){
    function owl_carousel($images=array(),$height=300,$attr=array('class'=>'owl-carousel','data-autoplay'=>'true','data-animateOut'=>'fadeOut') ){
        
        $htmlImg = array();
        foreach ($images as $idxImg => $image) {
            
            $imgActive=$idxImg==0?"active":"";
            array_push($htmlImg, "<div class=\"item {$imgActive}\" style=\" background: url({$image}) no-repeat center center; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;\"><img src=\"".asset_url('front/images/blank.gif')."\" alt=\"{$image}\" height=\"$height\" style=\"height: {$height}px;
  max-height: {$height}px;\"></div>");
        }
        
        $html = "<div ".  html_properites($attr)." >";
        $html .= implode($htmlImg, " ");
        $html .="</div>";
        
       return $html;
        
    }
}


if(!function_exists('boostrap_carousel')){
    function boostrap_carousel($images=array(),$height=300,$attr=array('id'=>'carousel','class'=>'carousel slide carousel-fade','data-ride'=>"carousel",'data-interval'=>"5000") ){
        
        $htmlImg = array();
        foreach ($images as $idxImg => $image) {
            $imgActive=$idxImg==0?"active":"";
            array_push($htmlImg, "<div class=\"item {$imgActive}\" style=\" background: url({$image}) no-repeat center center; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;\"><img src=\"".asset_url('front/images/blank.gif')."\" alt=\"{$image}\" height=\"$height\" style=\"height: {$height}px;
  max-height: {$height}px;\"></div>");
        }
        
        $html = "<div ".  html_properites($attr)." >";
        $html .= "<div class=\"carousel-inner\" role=\"listbox\">".  implode($htmlImg, " ")."</div>";
        $html .="</div>";
        
       return $html;
        
    }
}

if(!function_exists('html_properites')){
function html_properites($html_prop=array()){
    $props=array();
    
    foreach($html_prop as $key=>$prop){
        array_push($props,"{$key}=\"{$prop}\"");
    }
    return implode(" ", $props);
}
}
