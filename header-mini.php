<?php
/**
 * The Header for our theme.
 *
 *
 * @package Polis Theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link href='http://fonts.googleapis.com/css?family=Bitter:400,700,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <?php wp_head(); ?>

    <!-- Google Analytics -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-24934230-2', 'auto');
      ga('send', 'pageview');
    </script>

</head>
<body <?php body_class(); ?> data-siteurl="<?php bloginfo('url');?>/" id="mini-header-body">
<div id="map-bg"></div>
<div class="container shadow">
    <nav class="col-md-12 nav" id="nav" data-inload="true">
        <a href="<?php bloginfo('url');?>">
            <img src="<?php bloginfo('template_url');?>/img/logo-mini.png">
        </a>
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
    </nav>
    <div class="content-bg">