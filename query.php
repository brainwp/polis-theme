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
		// Equipe
		'equipe'       => false,
		// Variaveis das Areas do site
		'area'         => false,
		'area_archive' => false,
		// Noticias
		'noticias'     => false,
		// Publicacoes
		'publicacoes'  => false,
		//Acoes
		'acoes'        => false,
		//Canal
		'canal'        => false,
		//Boletim
		'boletim'      => false,

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

	} elseif ( get_query_var( 'template' ) == 'equipe-area' ) {
		_query_equipe_area();

	} elseif ( get_query_var( 'template' ) == 'membros' ) {

		_query_membros();

	} elseif ( get_query_var( 'template' ) == 'projetos' ) {

		_query_projetos();

	} elseif ( get_query_var( 'template' ) == 'projetos' ) {

		_query_area_cpt();

	} elseif ( get_query_var( 'template' ) == 'noticias-e-acoes' ) {

		_query_noticias_acoes();

	} elseif ( get_query_var( 'template' ) == 'area-cpt' ) {
		_query_area_categoria();

	} elseif ( get_query_var( 'template' ) == 'archive-publicacoes' ) {

		_query_archive_publicacoes();

	} elseif ( get_query_var( 'template' ) == 'canal' ) {

		_query_canal();

	} elseif ( get_query_var( 'template' ) == 'colecoes' ) {

		_query_colecoes();

	} elseif ( get_query_var( 'template' ) == 'redirect_js_institucional' ) {

		redirect_js_institucional();

	}

	if ( get_query_var( 'select_query' ) == 'area-cat' ) {

		_query_area_categoria();

	}
	if ( get_query_var( 'select_query' ) == 'tipo' ) {

		_query_tipo();

	}


	/* Template redirect */

	/* Put something here to do suff in all queries */
}

function redirect_js_institucional() {
	$_slug = get_query_var( 'pslug' );

	$_url = get_bloginfo( 'url' ) . '/institucional/#page_' . $_slug;
	wp_redirect( $_url );
	exit;
}

function _query_tipo() {
	global $_query, $wp_query;
	$page                = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$per_page            = (int) of_get_option( 'areas-archive-per-page' );
	$tipo                = get_query_var( 'taxtipo' );
	$args                = array(
		'post_type'      => get_query_var( 'cpt' ),
		'tax_query'      => array(
			array(
				'taxonomy'         => 'tipos',
				'terms'            => $tipo,
				'field'            => 'slug',
				'include_children' => true,
				'operator'         => 'IN'
			)
		),
		'orderby'        => 'date',
		'order'          => 'ASC',
		'posts_per_page' => $per_page,
		'paged'          => $page
	);
	$_query->query       = new WP_Query( $args );
	$_query->_page       = $page;
	$_query->total_pages = $_query->query->max_num_pages;
	$term                = get_term_by( 'slug', $tipo, 'tipos' );
	$_query->tax_name    = $term->name;
}

function _query_area_categoria() {
	global $_query;
	$page                = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$per_page            = (int) of_get_option( 'areas-archive-per-page' );
	$area                = get_query_var( 'area' );
	$cpt                 = get_query_var( 'cpt' );
	$_query->area        = $area;
	$_query->cpt         = $cpt;
	$args                = array(
		'post_type'      => get_query_var( 'cpt' ),
		'tax_query'      => array(
			array(
				'taxonomy'         => 'areas',
				'terms'            => $area,
				'field'            => 'slug',
				'include_children' => true,
				'operator'         => 'IN'
			)
		),
		'orderby'        => 'date',
		'order'          => 'DESC',
		'posts_per_page' => $per_page,
		'paged'          => $page
	);
	$_query->query       = new WP_Query( $args );
	$_query->_page       = $page;
	$_query->total_pages = $_query->query->max_num_pages;
}

function _query_archive_publicacoes() {
	global $_query;

	$page     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$per_page = 30;

	$args = array(
		'post_type'      => array( 'publicacoes' ),
		'posts_per_page' => $per_page,
		'paged'          => $page
	);


	$_query->query           = new WP_Query( $args );
	$_query->_page       = $page;
	$_query->total_pages = $_query->query->max_num_pages;

}

function _query_canal() {

	global $_query;
	$args = array(
		'post_type' => 'videos',
		'posts_per_page' => (int) of_get_option( 'areas-archive-per-page' ),
		'paged' => ( isset($_GET['pagina']) ) ? $_GET['pagina'] : 1
	);

	$_query->canal = new WP_Query( $args );
}

function _query_colecoes() {

	global $_query, $query;
	$page     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$termo    = get_query_var( 'termo' );
	$per_page = (int) of_get_option( 'colecoes-per-page' );
	$cat      = get_term_by( 'slug', $termo, 'tipos' );
	if ( ! empty( $cat->name ) ) {
		$args                     = array(
			'post_type'      => 'publicacoes',
			'posts_per_page' => $per_page,
			'paged'          => $page,
			'tax_query'      => array(
				array(
					'taxonomy'         => 'tipos',
					'field'            => 'slug',
					'terms'            => $termo,
					'include_children' => true,
				)
			)
		);
		$_query->term_description = $cat->description;
		$_query->term_name        = $cat->name;
		$_query->boletim          = new WP_Query( $args );
		$_query->page             = $page;
		$_query->total_pages      = $_query->boletim->max_num_pages;
		$_query->template = 'colecoes';

	} else {
		include get_template_directory() . '/404.php';
		header( "HTTP/1.0 404 Not Found" );
		die();
	}
}

function _query_noticias_acoes() {

	global $_query;

	$page     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$per_page = get_option( 'posts_per_page' );

	$args = array(
		'post_type'      => array( 'noticias', 'acoes' ),
		'orderby'        => 'date',
		'order'          => 'DESC',
		'posts_per_page' => $per_page,
		'paged'          => $page
	);

	$_query->query       = new WP_Query( $args );
	$_query->_page       = $page;
	$_query->total_pages = $_query->query->max_num_pages;

}

function _query_projetos() {

	//redireciona o usuario caso ele esteja numa página > 1 no projetos sem tax selecionada (utilizando a padrão)
	if ( isset( $_GET['aba_pag'] ) ) {
		$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '';
		if ( empty( $page ) ) {
			header( 'Location: ' . get_bloginfo( 'url' ) . '/projetos/tipo/' . $_GET['aba_pag'] );
		} else {
			header( 'Location: ' . get_bloginfo( 'url' ) . '/projetos/tipo/' . $_GET['aba_pag'] . '/page/' . $page );
		}
	}

	global $_query;
	$args = array(
		'type'       => 'projetos',
		'taxonomy'   => 'projetos_tax',
		'hide_empty' => 1,
	);

	$categories = get_categories( $args );
	foreach ( $categories as $category ) {
		$_query->first_tax = $category;
		$first_tax_slug = $category->slug;
		break;
	}
	if(empty($first_tax)){
		$first_tax_slug = '';
	}
	$page           = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$_aba           = ( get_query_var( 'aba' ) ) ? get_query_var( 'aba' ) : false;
	$_query->aba_if = $_aba;
	$aba            = ( get_query_var( 'aba' ) ) ? get_query_var( 'aba' ) : $first_tax_slug;
	$args           = array(
		'post_type'      => array( 'projetos' ),
		'posts_per_page' => 999999999999,
		'projetos_tax'   => $aba
	);

	$count_query = new WP_Query( $args );
	if ( $count_query->found_posts == 0 ) {
		include get_template_directory() . '/404.php';
		header( "HTTP/1.0 404 Not Found" );
		die();
	}

	$_query->found_posts = $count_query->found_posts;

	$per_page = (int) get_option( 'projetos_per_page' );

	$args = array(
		'post_type'      => array( 'projetos' ),
		'orderby'        => 'date',
		'order'          => 'ASC',
		'posts_per_page' => $per_page,
		'projetos_tax'   => $aba,
		'paged'          => $page
	);

	$_query->query = new WP_Query( $args );

	$_query->projetos_tax_slug = $aba;
	$_query->total_pages       = $_query->query->max_num_pages;
}

function _query_equipe() {

	global $_query;

	$_query->exclude = explode( ',', of_get_option( 'equipe-exclude' ) );

	$count_args = array(

		'fields'  => 'all_with_meta',
		'number'  => 9999999999,
		'exclude' => $_query->exclude

	);

	$user_count_query = new WP_User_Query( $count_args );

	$user_count = $user_count_query->get_results();

// grab the current page number and set to 1 if no page number is set

	$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	$total_users = $user_count ? count( $user_count ) : 1;

// how many users to show per page

	$users_per_page = (int) of_get_option( 'equipe-per-page' );

// calculate the total number of pages.

	$total_pages = 1;

	$offset = $users_per_page * ( $page - 1 );

	$total_pages = ceil( $total_users / $users_per_page );

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

function _query_equipe_area() {

	global $_query;

	$_query->exclude   = explode( ',', of_get_option( 'equipe-exclude' ) );
	$_query->user_area = get_query_var( 'user_area' );

	if ( $_query->user_area == 'democracia-e-participacao' ) {
		$_query->user_area = 'democracia';
	}
	if ( $_query->user_area == 'inclusao-e-sustentabilidade' ) {
		$_query->user_area = 'inclusao';
	}
	if ( $_query->user_area == 'reforma-urbana' ) {
		$_query->user_area = 'reforma';
	}
	if ( $_query->user_area == 'cidadania-cultural' ) {
		$_query->user_area = 'cidadania';
	}

	//echo get_query_var( 'user_area' );
	$count_args = array(

		'fields'     => 'all_with_meta',
		'number'     => 9999999999,
		'exclude'    => $_query->exclude,
		'meta_key'   => 'area',
		'meta_value' => $_query->user_area

	);

	$user_count_query = new WP_User_Query( $count_args );

	$user_count = $user_count_query->get_results();


// grab the current page number and set to 1 if no page number is set

	$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	$total_users = $user_count ? count( $user_count ) : 1;

// how many users to show per page

	$users_per_page = (int) of_get_option( 'equipe-per-page' );

// calculate the total number of pages.

	$total_pages = 1;

	$offset = $users_per_page * ( $page - 1 );

	$total_pages = ceil( $total_users / $users_per_page );

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

function _query_membros() {

	global $wp_query, $_query, $user;

	$_user = get_user_by( 'login', get_query_var( 'nome' ) );

	if ( username_exists( $wp_query->query_vars['nome'] ) ) {

		$count_args = array(

			'post_type'     => array( 'noticias', 'acoes', 'post', 'publicacoes' ),
			'author'        => $_user->ID,
			'post_per_page' => 999999

		);

		$count_query = new WP_Query( $count_args );

		$count = $count_query->found_posts;

// grab the current page number and set to 1 if no page number is set

		$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		$total_posts = $count;

		$per_page = 4;
// calculate the total number of pages.

		$offset = $per_page * ( $page - 1 );

		$wp_query->is_404 = false;

		$_avatar = get_avatar( $_user->ID, 200 );

		$_area_slug = get_field( 'area', 'user_' . $_user->ID );
		if ( $_area_slug == 'Institucional' || $_area_slug == 'Outro' ) {
			$_area_slug = 'default';
		} else {
			$_area_slug_term = get_term_by( 'slug', $_area_slug, 'areas' );
			if ( $_area_slug_term->parent != 0 ) {
				$_top_term  = get_term_by( 'id', $_area_slug_term->parent, 'areas' );
				$_area_slug = explode( '-', trim( $_top_term->slug ) );
				$_area_slug = $_area_slug[0];
			}
		}
		$_cargo = get_field( 'cargo', 'user_' . $_user->ID );

		$_tel = get_field( 'telefone', 'user_' . $_user->ID );

		$_twitter = get_field( 'twitter', 'user_' . $_user->ID );

		$_email = get_field( 'email', 'user_' . $_user->ID );

		$_query->offset = $offset;

		$_query->per_page = $per_page;

		$_query->_page = $page;

		$_query->area_slug = $_area_slug;

		$_query->cargo = $_cargo;

		$_query->tel = $_tel;

		$_query->email = $_email;

		$_query->twitter = $_twitter;

		$_query->avatar = $_avatar;

		$_query->nome = get_query_var( 'nome' );

		$_query->user_id = $_user->ID;

		$user = $_user;

		$select_posts = get_field( 'in_atividade_slider', 'user_' . $_user->ID );

		$select_posts = explode( ',', $select_posts );

		$args = array(

			'post_type'     => array( 'noticias', 'acoes', 'post', 'publicacoes' ),
			'post_per_page' => 8,
			'post__in'      => $select_posts
		);

		$_query->query = new WP_Query( $args );

		$total_pages = $_query->query->max_num_pages;

		$_query->total_pages = $total_pages;

		$_query->error = false;

	} else {

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
	$args = array(

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

	$args = array(

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

	$args = array(

		'post_type' => 'acoes',
		'tax_query' => array(

			array(

				'taxonomy'         => 'categorias',
				'field'            => 'slug',
				'terms'            => $area,
				'include_children' => true,
				'posts_per_page'   => 12,

			)

		)

	);

	$_query->acoes = new WP_Query( $args ); // exclude category

}

function _query_archive_noticias( $area ) {

	global $wp_query;

	$args = array(

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

		}


		if ( $type == 'restaurante' ) {

			$_query->titulo = 'Produtos';

			$wp_query = new WP_Query( array(

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

			$wp_query = new WP_Query( array(

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

			$wp_query = new WP_Query( array(

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

	if ( $_query->template == 'membros' && $_query->error == false ) {

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

	} elseif ( $_query->template == 'noticias-e-acoes' ) {

		if ( $_query->_page != 1 ) {

			$title = 'Noticias e Ações | ' . $title = get_bloginfo( 'name' );

			return $title;

		} else {

			$title = get_bloginfo( 'name' ) . ' | Notícias e Ações | Página ' . $_query->_page;

			return $title;

		}

	} elseif ( $_query->template == 'archive-publicacoes' ) {

		if ( $_query->_page == 1 ) {

			$title = 'Publicações | ' . $title = get_bloginfo( 'name' );

			return $title;

		} else {

			$title = get_bloginfo( 'name' ) . ' | Publicações | Página ' . $_query->_page;

			return $title;

		}

	} elseif ( $_query->template == 'colecoes' ) {

		$title = 'Coleções | ' . get_bloginfo( 'name' );

		return $title;

	} elseif ( $_query->template == 'projetos' ) {


		$title = get_bloginfo( 'name' ) . ' | Projetos ';

		return $title;


	} else {

		return $title;

	}


}

add_filter( 'wp_title', '_title' );
//query funcionando
