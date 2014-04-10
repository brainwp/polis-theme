<?php

/**
 * Query object
 *
 * As the query processor relies on a global `$_query` object, we should
 * declare it and document each of the attributes of this object here.
 */
add_action( 'init', '_init_query_object' );
function _init_query_object() {

    global $_query;
    $_query = (object) array(

        // Choose a different template
        'template' => false,

        // Variáveis das Áreas do site
        'area' => false,
		'area_archive' => false,
		
		// Noticias
		'noticias' => false,

		// Publicacoes
		'publicacoes' => false,

    );

}

/**
 * Query processor
 *
 * All requests will pass throught this function to receive more custom data in
 * a set of `if` conditions. These conditions can either be defined by default
 * WordPress queries or by the custom rewrite rule of the theme's router.
 *
 * To modify the main WordPress query, replace the `$wp_query` for a new
 * `WP_Query` instance. For example:
 * $wp_query = new WP_Query( $new_query_vars );
 *
 * To get data from a custom query set in the rewrite rule, simply do the same
 * with the $_query object:
 * $_query = new WP_Query( $query_vars );
 *
 * If there's something to be given at all queries like footer menus or sidebar
 * items, just put it in the end outside the `if` condition.
 */
function _query_processor( &$query ) {

    global $_query, $post, $wpdb, $wp_query;

    /* Main home */

    if ( $query->is_home() && !$_query ) {


    /* Search page */

    } elseif( $query->get( 's' ) ) {


    /* Archives */

    } elseif ( $query->is_archive() ) {


    /* Singles */

    } elseif ( $query->is_single() ) {


    /* 404 error */

    } elseif ( $query->is_404() ) {

	} elseif ( 'noticias' == get_query_var( 'area_archive' ) ) {
		$area = get_query_var( 'area' );
		_query_archive_noticias( $area );

    /* Democracia e Participacao */

    } elseif ( 'democracia-e-participacao' == get_query_var( 'area' ) ) {
		$area = 'democracia-e-participacao';
		_query_noticias( $area );
		_query_publicacoes( $area );

	/* Democracia e Participacao */

    } elseif ( 'reforma-urbana' == get_query_var( 'area' ) ) {
		$area = 'reforma-urbana';
		_query_noticias( $area );
		_query_publicacoes( $area );

    /* The sample query */

    } elseif ( $q = get_query_var( 'sample_query' ) ) {

        $_query->sample_query = 'Nice!';

    }

    /* Put something here to do suff in all queries */

	$_query->template = ! $_query->template ? get_query_var( 'template' ) : false;

}

function _query_noticias( $area ) {
	global $_query;
	$args = array(
		'post_type' => 'noticias',
		'tax_query' => array(
			array(
				'taxonomy' => 'categorias',
				'field' => 'slug',
				'terms' => $area,
				'include_children' => true,
				'posts_per_page' => 8,
			)
		)
	);
	$_query->noticias = new WP_Query( $args ); // exclude category
}

function _query_publicacoes( $area ) {
	global $_query;
	$args = array(
		'post_type' => 'publicacoes',
		'tax_query' => array(
			array(
				'taxonomy' => 'categorias',
				'field' => 'slug',
				'terms' => $area,
				'include_children' => true,
				'posts_per_page' => 10,
			)
		)
	);
	$_query->publicacoes = new WP_Query( $args ); // exclude category
}

function _query_archive_noticias( $area ) {
	global $wp_query;
	$args = array(	
		'post_type' => 'noticias',
		'tax_query' => array(
			array(
				'taxonomy' => 'categorias',
				'field' => 'slug',
				'terms' => $area,
				'include_children' => true,
				'posts_per_page' => 10,
			)
		)
	);
	$wp_query = new WP_Query( $args );
}
