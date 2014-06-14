<?php

/**
 * Query object
 *
 * As the query processor relies on a global `$_query` object, we should
 * declare it and document each of the attributes of this object here.
 */
add_action( 'init', '_init_query_object' );
function _init_query_object() {
	add_rewrite_tag( '%nome%', '(.+)' );

	global $_query;
	$_query = (object) array(

		// Choose a different template
		'template'     => false,

		// Blog
		'equipe'       => false,

		// Vari�veis das �reas do site
		'area'         => false,
		'area_archive' => false,

		// Noticias
		'noticias'     => false,

		// Publicacoes
		'publicacoes'  => false,

		//Acoes
		'acoes'        => false,

		//Canal Pólis
		'canal'        => false,

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

function _query_processor( $query ) {

	global $_query, $post, $wpdb, $wp_query;
	$_query->template = ! $_query->template ? get_query_var( 'template' ) : false;
	$_query->paged    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	/* Main home */

	if ( $query->is_home() && ! $_query ) {

		/* Search page */

	} elseif ( $query->get( 's' ) ) {

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
		_query_acoes( $area );
		_query_noticias( $area );
		_query_publicacoes( $area );

		/* Reforma Urbana */

	} elseif ( 'reforma-urbana' == get_query_var( 'area' ) ) {
		$area = 'reforma-urbana';
		_query_acoes( $area );
		_query_noticias( $area );
		_query_publicacoes( $area );

		/* Cidadania Cultural */

	} elseif ( 'cidadania-cultural' == get_query_var( 'area' ) ) {
		$area = 'cidadania-cultural';
		_query_acoes( $area );
		_query_noticias( $area );
		_query_publicacoes( $area );

		/* The sample query */

	} elseif ( $q = get_query_var( 'sample_query' ) ) {

		$_query->sample_query = 'Nice!';

	} elseif ( get_query_var( 'template' ) == 'equipe' ) {
		_query_equipe();
	} elseif ( get_query_var( 'template' ) == 'membros' ) {
		_query_membros();
	} elseif ( get_query_var( 'template' ) == 'canal' ) {
		_query_canal();
	}
	/* Template redirect */


	/* Put something here to do suff in all queries */

}
function _query_equipe(){
	global $_query;
	$count_args       = array(
		'fields' => 'all_with_meta',
		'number' => 999999
	);
	$user_count_query = new WP_User_Query( $count_args );
	$user_count       = $user_count_query->get_results();
// grab the current page number and set to 1 if no page number is set
	$page        = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$total_users = $user_count ? count( $user_count ) : 1;
// how many users to show per page
	$users_per_page = 16;
// calculate the total number of pages.
	$total_pages = 1;
	$offset       = $users_per_page * ( $page - 1 );
	$total_pages  = ceil( $total_users / $users_per_page );
	if ( $page <= $total_pages ) {
		$_query->total_pages = $total_pages;
		$_query->offset = $offset;
		$_query->users_per_page = $users_per_page;
		$_query->_page = $page;
		$_query->total_pages = $total_pages;
		$_query->error = false;
	} else {
		$_query->error = true;
	}
}
function _query_membros(){
	global $wp_query, $_query, $user;
	$_user = get_user_by( 'login', get_query_var('nome') );
	if(username_exists($wp_query->query_vars['nome'])){
		$count_args = array(
			'post_type' => array('noticias', 'acoes', 'post', 'publicacoes'),
			'author' => $_user->ID,
			'post_per_page' => 999999
		);
		$count_query = new WP_Query( $count_args );
		$count = $count_query->found_posts;
// grab the current page number and set to 1 if no page number is set
		$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$total_posts = $count;
		$per_page = 4;

// calculate the total number of pages.
		$offset = $per_page * ( $page - 1 );
		$total_pages = ceil( $total_posts / $per_page );

		$wp_query->is_404=false;
		$_avatar = get_avatar( $_user->ID, 200 );
		$_area_slug   = get_field( 'area', 'user_' . $_user->ID );
		if($_area_slug == 'reforma'){
			$_area = 'Reforma Urbana';
		}
		elseif($_area_slug == 'inclusao'){
			$_area = 'Inclusão e Sustentabilidade';
		}
		elseif($_area_slug == 'democracia'){
			$_area = 'Democracia e Participação';
		}
		elseif($_area_slug == 'cidadania'){
			$_area = 'Cidadania Cultural';
		}
		else{
			$_area = 'Cargo';
		}
		$_query->total_pages = $total_pages;
		$_query->offset = $offset;
		$_query->per_page = $per_page;
		$_query->_page = $page;
		$_query->total_pages = $total_pages;
		$_query->area = $_area;
		$_query->area_slug = $_area_slug;
		$_query->avatar = $_avatar;
		$_query->nome = get_query_var('nome');
		$user = $_user;
		$args = array(
			'author' => $user->ID,
			'post_type' => array('noticias', 'acoes', 'post', 'publicacoes'),
			'showposts'  => $_query->per_page,
			'offset'  => $_query->offset // skip the number of users that we have per page
		);
		$wp_query = new WP_Query($args);
		$_query->error = false;
	}
	else{
		$_query->error = true;
	}
}
function _query_blog() {

	global $wp_query, $_query;

	$_query->titulo = 'Blog';

	$wp_query = new WP_Query( array(
		'post_type' => 'post',
		'order'     => 'ASC'
	) );

}

function _query_noticias( $area ) {
	global $_query;
	$args             = array(
		'post_type' => 'noticias',
		'tax_query' => array(
			array(
				'taxonomy'         => 'categorias',
				'field'            => 'slug',
				'terms'            => $area,
				'include_children' => true,
				'posts_per_page'   => 8,
			)
		)
	);
	$_query->noticias = new WP_Query( $args ); // exclude category

}

function _query_publicacoes( $area ) {
	global $_query;
	$args                = array(
		'post_type' => 'publicacoes',
		'tax_query' => array(
			array(
				'taxonomy'         => 'categorias',
				'field'            => 'slug',
				'terms'            => $area,
				'include_children' => true,
				'posts_per_page'   => 10,
			)
		)
	);
	$_query->publicacoes = new WP_Query( $args ); // exclude category
}

function _query_acoes( $area ) {
	global $_query;
	$args          = array(
		'post_type' => 'acoes',
		'tax_query' => array(
			array(
				'taxonomy'         => 'categorias',
				'field'            => 'slug',
				'terms'            => $area,
				'include_children' => true,
				'posts_per_page'   => 10,
			)
		)
	);
	$_query->acoes = new WP_Query( $args ); // exclude category
}

function _query_archive_noticias( $area ) {
	global $wp_query;
	$args     = array(
		'post_type' => 'noticias',
		'tax_query' => array(
			array(
				'taxonomy'         => 'categorias',
				'field'            => 'slug',
				'terms'            => $area,
				'include_children' => true,
				'posts_per_page'   => 10,
			)
		)
	);
	$wp_query = new WP_Query( $args );
}

function _query_canal() {
}

function _query_produtos() {
	$type = $_GET['p-type'];
	global $wp_query, $_query;

	if ( empty( $type ) ) {
		$_query->titulo = 'Produtos';

		$wp_query = new WP_Query( array(
			'post_type' => 'produtos',
			'order'     => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'tipos',
					'field'    => 'soft',
				)
			),
		) );
	} else {
		if ( $type == 'soft' ) {
			$_query->titulo = 'Produtos';
			$wp_query       = new WP_Query( array(
				'post_type' => 'produtos',
				'order'     => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'tipos',
						'field'    => 'soft',
					)
				),
			) );
		}

		if ( $type == 'restaurante' ) {
			$_query->titulo = 'Produtos';
			$wp_query       = new WP_Query( array(
				'post_type' => 'produtos',
				'order'     => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'tipos',
						'field'    => 'restaurante',
					)
				),
			) );
		}

		if ( $type == 'chocolate-e-creme' ) {
			$_query->titulo = 'Produtos';
			$wp_query       = new WP_Query( array(
				'post_type' => 'produtos',
				'order'     => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'tipos',
						'field'    => 'chocolate-e-creme',
					)
				),
			) );
		}
		if ( $type == 'artesanal' ) {
			$_query->titulo = 'Produtos';
			$wp_query       = new WP_Query( array(
				'post_type' => 'produtos',
				'order'     => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'tipos',
						'field'    => 'slug',
						'term'     => 'artesanal'
					)
				),
			) );
		}
	}
}

function _title( $title ) {
	global $wp_query, $_query;

	if ( $_query->template == 'membros' && $_query->error == false) {
		$title = get_bloginfo( 'name' ) . ' | Equipe | ' . $_query->nome;

		return $title;
	} elseif ( $_query->template == 'equipe' ) {
		if ( $_query->_page != 1 ) {
			$title = get_bloginfo( 'name' ) . ' | Equipe';

			return $title;
		} else {
			$title = get_bloginfo( 'name' ) . ' | Equipe | Pagina ' . $_query->_page;

			return $title;
		}
	} else {
		return $title;
	}
}

add_filter( 'wp_title', '_title' );
