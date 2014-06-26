<?php
/**
 * Adicionamos uma ação no inicio do carregamento do WordPress
 * através da funçãoo add_action( 'init' )
 */
add_action( 'init', 'create_post_type_publicacoes' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_publicacoes() {

    /**
     * Labels customizados para o tipo de post
     */
    $labels = array(
	    'name' => _x('Publicações', 'post type general name'),
	    'singular_name' => _x('Publicação', 'post type singular name'),
	    'add_new' => _x('Nova Publicação', 'itens'),
	    'add_new_item' => __('Nova Publicação'),
	    'edit_item' => __('Editar Publicação'),
	    'new_item' => __('Nova Publicação'),
	    'all_items' => __('Todas Publicações'),
	    'view_item' => __('Ver Publicação'),
	    'search_items' => __('Procurar Publicação'),
	    'not_found' =>  __('Nenhuma Publicação Encontrada'),
	    'not_found_in_trash' => __('Nenhuma Publicação encontrada no Lixo'),
	    'parent_item_colon' => '',
	    'menu_name' => 'Publicações'
    );
    
    /**
     * Registamos o tipo de post colecoes através desta função
     * passando-lhe os labels e parâmetros de controlo.
     */
    register_post_type( 'publicacoes', array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    'show_in_menu' => true,
	    'query_var' => true,
		'rewrite' => array(
		 'slug' => 'publicacoes',
		 'with_front' => false,
	    ),
	    'capability_type' => 'post',
	    'has_archive' => true,
	    'hierarchical' => true,
	    'menu_position' => 5,
	    'supports' => array('title','editor','thumbnail','post-formats','taxonomy')
	    )
    );

	flush_rewrite_rules();

}