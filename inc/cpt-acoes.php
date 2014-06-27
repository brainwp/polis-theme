<?php
/**
 * Adicionamos uma ação no inicio do carregamento do WordPress
 * através da funçãoo add_action( 'init' )
 */
add_action( 'init', 'create_post_type_acoes' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_acoes() {

    /**
     * Labels customizados para o tipo de post
     */
    $labels = array(
	    'name' => _x('Ações', 'post type general name'),
	    'singular_name' => _x('Ação', 'post type singular name'),
	    'add_new' => _x('Nova Ação', 'itens'),
	    'add_new_item' => __('Nova Ação'),
	    'edit_item' => __('Editar Ação'),
	    'new_item' => __('Nova Ação'),
	    'all_items' => __('Todas Ações'),
	    'view_item' => __('Ver Ação'),
	    'search_items' => __('Procurar Ação'),
	    'not_found' =>  __('Nenhuma Ação Encontrada'),
	    'not_found_in_trash' => __('Nenhuma Ação encontrada no Lixo'),
	    'parent_item_colon' => '',
	    'menu_name' => 'Ações'
    );
    
    /**
     * Registamos o tipo de post colecoes através desta função
     * passando-lhe os labels e parâmetros de controlo.
     */
    register_post_type( 'acoes', array(
	    'labels' => $labels,
	    'menu_icon' => 'dashicons-megaphone',
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    'show_in_menu' => true,
	    /*'has_archive' => 'itens',*/
	    'query_var' => true,
		'rewrite' => array(
		 'slug' => 'acoes',
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