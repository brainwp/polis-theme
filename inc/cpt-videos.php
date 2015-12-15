<?php
/**
 * Adicionamos uma ação no inicio do carregamento do WordPress
 * através da função add_action( 'init' )
 */
add_action( 'init', 'create_post_type_videos' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_videos() {

    /**
     * Labels customizados para o tipo de post
     */
    $labels = array(
	    'name' => _x('Vídeos', 'post type general name'),
	    'singular_name' => _x('Vídeo', 'post type singular name'),
	    'add_new' => _x('Novo Vídeo', 'itens'),
	    'add_new_item' => __('Novo Vídeo'),
	    'edit_item' => __('Editar Vídeo'),
	    'new_item' => __('Novo Vídeo'),
	    'all_items' => __('Todos Vídeos'),
	    'view_item' => __('Ver Vídeo'),
	    'search_items' => __('Procurar Vídeo'),
	    'not_found' =>  __('Nenhum Vídeo Encontrado'),
	    'not_found_in_trash' => __('Nenhum Vídeo encontrado no Lixo'),
	    'parent_item_colon' => '',
	    'menu_name' => 'Vídeos'
    );
    
    /**
     * Registamos o tipo de post através desta função
     * passando-lhe os labels e parâmetros de controle.
     */
    register_post_type( 'videos', array(
	    'labels' => $labels,
	    'menu_icon' => 'dashicons-format-video',
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    'show_in_menu' => true,
	    'query_var' => true,
		'rewrite' => array(
		 'slug' => 'videos',
		 'with_front' => false,
	    ),
	    'capability_type' => 'post',
	    'has_archive' => true,
	    'hierarchical' => true,
	    'menu_position' => 10,
	    'supports' => array('title','author','editor','comments','thumbnail')
	    )
    );
	flush_rewrite_rules();
}