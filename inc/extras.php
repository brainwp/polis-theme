<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Polis Theme
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function polis_theme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'polis_theme_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function polis_theme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'polis_theme_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function polis_theme_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'polis-theme' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'polis_theme_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function polis_theme_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'polis_theme_setup_author' );

add_action( 'dashboard_glance_items', 'polis_widget_now' );
function polis_widget_now() {
	$args = array(
	'public' => true ,
	'_builtin' => false
	);
 	$output = 'object';
 	$operator = 'and';
 	$post_types = get_post_types( $args, $output, $operator );
 	foreach( $post_types as $post_type ) {
  		$num_posts = wp_count_posts( $post_type->name );
  		$num = number_format_i18n( $num_posts->publish );
  		$text = _n( $post_type->labels->singular_name, $post_type->labels->name, intval( $num_posts->publish ) );
  		if ( current_user_can( 'edit_posts' ) ) {
   			echo "<li class=\"post-type-count\"><a href='edit.php?post_type=$post_type->name'>$num ";
   			echo "$text</a></li>";
  		} else {
  			echo "<li class=\"post-type-count\">";
  		}
 	}
 
 	$taxonomies = get_taxonomies( $args, $output, $operator );
	foreach( $taxonomies as $taxonomy ) {
		$num_terms = wp_count_terms( $taxonomy->name );
		$num = number_format_i18n( $num_terms );
		$text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name , intval( $num_terms ));
		if ( current_user_can( 'manage_categories' ) ) {
			echo "<li class=\"tax-count\"><a href='edit-tags.php?taxonomy=$taxonomy->name'>$num ";
			echo "$text</a></li>";
		} else {
			echo "<li class=\"tax-count\">$num $text</li>";
		}
	}
}