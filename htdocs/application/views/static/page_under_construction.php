<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <title> <?php echo config_item('theme_title'); ?></title>
        <meta name="description" content="<?php echo config_item('theme_description'); ?>">
        <meta name="author" content="<?php echo config_item('theme_author'); ?>">
        <meta name="viewport" content="<?php echo config_item('theme_viewport'); ?>">

        <!-- #CSS Links -->
        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset_url('css/bootstrap.min.css') ?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset_url('css/font-awesome.min.css') ?>">

        <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset_url('css/smartadmin-production-plugins.min.css'); ?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset_url('css/smartadmin-production.min.css'); ?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset_url('css/smartadmin-skins.min.css'); ?>">
        
        <!--<link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset_url('css/my_style.css'); ?>">-->

        <!-- SmartAdmin RTL Support -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset_url('css/smartadmin-rtl.min.css') ?>"> 

        <?php foreach (config_item('theme_custom_css') as $css): ?>
            <link rel="stylesheet" type="text/css" media="screen" href="<?php echo asset_url($css); ?>">    
        <?php endforeach; ?>

        <!-- #FAVICONS -->
        <link rel="shortcut icon" href="<?php echo asset_url('img/favicon/favicon.ico') ?>" type="image/x-icon">
        <link rel="icon" href="<?php echo asset_url('img/favicon/favicon.ico') ?>" type="image/x-icon">

        <!-- #GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <link rel="apple-touch-icon" href="<?php echo asset_url('img/splash/sptouch-icon-iphone.png') ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo asset_url('img/splash/touch-icon-ipad.png') ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo asset_url('img/splash/touch-icon-iphone-retina.png') ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo asset_url('img/splash/touch-icon-ipad-retina.png') ?>">

        <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Startup image for web apps -->
        <link rel="apple-touch-startup-image" href="<?php echo asset_url('img/splash/ipad-landscape.png') ?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="<?php echo asset_url('img/splash/ipad-portrait.png') ?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="<?php echo asset_url('img/splash/iphone.png') ?>" media="screen and (max-device-width: 320px)">
   

    </head>

    <!-- #BODY -->
    
    
    <body >
        <div id="main" role="main">

			<!-- MAIN CONTENT -->

			<form class="lockscreen animated flipInY" action="index.html">
				<div class="logo">					
				</div>
				<div>
					<div>
                                            <h1>Under Construction</h1>
					</div>

				</div>
				<p class="font-xs margin-top-5">
					Copyright Stock 2014-2020.

				</p>
			</form>

		</div>

    </body>

</html>