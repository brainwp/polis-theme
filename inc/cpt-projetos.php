<?php
/**
 * Adicionamos uma ação no inicio do carregamento do WordPress
 * através da função add_action( 'init' )
 */
add_action( 'init', 'create_post_type_projetos' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_projetos() {

    /**
     * Labels customizados para o tipo de post
     */
    $labels = array(
	    'name' => _x('Projetos', 'post type general name'),
	    'singular_name' => _x('Projeto', 'post type singular name'),
	    'add_new' => _x('Novo Projeto', 'itens'),
	    'add_new_item' => __('Novo Projeto'),
	    'edit_item' => __('Editar Projeto'),
	    'new_item' => __('Novo Projeto'),
	    'all_items' => __('Todos Projetos'),
	    'view_item' => __('Ver Projeto'),
	    'search_items' => __('Procurar Projeto'),
	    'not_found' =>  __('Nenhum Projeto Encontrado'),
	    'not_found_in_trash' => __('Nenhum Projeto encontrado no Lixo'),
	    'parent_item_colon' => '',
	    'menu_name' => 'Projetos'
    );
    
    /**
     * Registamos o tipo de post através desta função
     * passando-lhe os labels e parâmetros de controle.
     */
    register_post_type( 'projetos', array(
	    'labels' => $labels,
	    'menu_icon' => 'dashicons-welcome-widgets-menus',
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    'show_in_menu' => true,
	    'query_var' => true,
		'rewrite' => array(
		 'slug' => 'projetos',
		 'with_front' => false,
	    ),
	    'capability_type' => 'post',
	    'has_archive' => true,
	    'hierarchical' => true,
	    'menu_position' => 5,
	    'supports' => array('title','author','editor','excerpt','thumbnail')
	    )
    );
	flush_rewrite_rules();
}