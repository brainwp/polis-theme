<?php
/**
 * Adicionamos uma ação no inicio do carregamento do WordPress
 * através da funçãoo add_action( 'init' )
 */
add_action( 'init', 'create_post_type_noticias' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_noticias() {

    /**
     * Labels customizados para o tipo de post
     */
    $labels = array(
	    'name' => _x('Notícias', 'post type general name'),
	    'singular_name' => _x('Notícia', 'post type singular name'),
	    'add_new' => _x('Nova Notícia', 'itens'),
	    'add_new_item' => __('Nova Notícia'),
	    'edit_item' => __('Editar Notícia'),
	    'new_item' => __('Nova Notícia'),
	    'all_items' => __('Todas Notícias'),
	    'view_item' => __('Ver Notícia'),
	    'search_items' => __('Procurar Notícia'),
	    'not_found' =>  __('Nenhuma Notícia Encontrada'),
	    'not_found_in_trash' => __('Nenhuma Notícia encontrada no Lixo'),
	    'parent_item_colon' => '',
	    'menu_name' => 'Notícias'
    );
    
    /**
     * Registamos o tipo de post colecoes através desta função
     * passando-lhe os labels e parâmetros de controlo.
     */
    register_post_type( 'noticias', array(
	    'labels' => $labels,
	    'menu_icon' => 'dashicons-format-aside',
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    'show_in_menu' => true,
	    'query_var' => true,
		'rewrite' => array(
		 'slug' => 'noticias',
		 'with_front' => false,
	    ),
	    'capability_type' => 'post',
	    'has_archive' => true,
	    'hierarchical' => true,
	    'menu_position' => 5,
	    'supports' => array('title','author','editor','excerpt','thumbnail','post-formats', 'taxonomy')
	    )
    );

	flush_rewrite_rules();

}