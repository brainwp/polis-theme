<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Polis Theme
 */

get_header(); ?>

<?php
	$current_user = wp_get_current_user();
	if ( current_user_can( 'create_users' ) ){
		migration();
	}
?>

<?php get_footer(); ?>