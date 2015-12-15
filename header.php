<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Polis Theme
 */
global $_query;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if ( $_query->template != 'colecoes' ) : ?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php else : ?>
	<title>Coleções | <?php bloginfo( 'name' );?></title>
<?php endif;?>

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
<body <?php body_class(); ?> data-siteurl="<?php bloginfo('url');?>/">
<div id="map-bg"></div>

<div class="container shadow">
	<header class="col-md-12 header">
		<a href="<?php bloginfo('url');?>" class="col-md-6 logo left">  <!-- logo -->
			<img src="<?php bloginfo('template_url');?>/img/logo.png">
		</a>
		<form class="col-md-5 left description" action="<?php bloginfo('url');?>/biblioteca/" method="get" id="header-search-form">
			<p class="desc">
				<?php echo of_get_option('frase-head'); ?>
			</p>
			<label class="left">Busque conteudo</label>
			<input type="search" placeholder="Digite e aperte enter" name="search_key">
			<span class="glyphicon glyphicon-search" id="header-search-bt"></span> <!-- icone de search !-->
		</form>
	</header>
	<nav class="col-md-12 nav" id="nav" data-inload="false">
        <a href="<?php bloginfo('url');?>">
            <img src="<?php bloginfo('template_url');?>/img/logo-mini.png">
        </a>
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav>

	<div class="content-bg">