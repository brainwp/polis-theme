<?php

/**
 * Adicionamos uma acção no inicio do carregamento do WordPress
 * através da função add_action( 'init' )
 */
add_action( 'init', 'create_post_type_produtos' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_produtos() {

    /**
     * Labels customizados para o tipo de post
     */
    $labels = array(
	    'name' => _x('Produtos', 'post type general name'),
	    'singular_name' => _x('Produto', 'post type singular name'),
	    'add_new' => _x('Novo Produto', 'produto'),
	    'add_new_item' => __('Novo Produto'),
	    'edit_item' => __('Editar Produto'),
	    'new_item' => __('Novo Produto'),
	    'all_items' => __('Todos Produtos'),
	    'view_item' => __('Ver Produto'),
	    'search_items' => __('Procurar Produto'),
	    'not_found' =>  __('Nenhum Produto Encontrado'),
	    'not_found_in_trash' => __('Nenhum Produto Encontrado no Lixo'),
	    'parent_item_colon' => '',
	    'menu_name' => 'Produtos'
    );
    
    /**
     * Registamos o tipo de post produtos através desta função
     * passando-lhe os labels e parâmetros de controlo.
     */
    register_post_type( 'produtos', array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    'show_in_menu' => true,
	    'has_archive' => 'produtos',
	    'query_var' => true,
		'rewrite' => array(
		 'slug' => 'produtos',
		 'with_front' => false,
	    ),
	    'capability_type' => 'post',
	    
	    'hierarchical' => true,
	    'menu_position' => null,
	    'supports' => array('title','editor','thumbnail')
	    )
    );

	flush_rewrite_rules();

}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts

function create_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x( 'Tipos', 'taxonomy general name' ),
    'singular_name' => _x( 'Tipo', 'taxonomy singular name' ),
    'search_items' =>  __( 'Procurar Tipo' ),
    'all_items' => __( 'Todos Tipos' ),
    'parent_item' => __( 'Tipo Pai' ),
    'parent_item_colon' => __( 'Tipo Pai:' ),
    'edit_item' => __( 'Editar Tipo' ), 
    'update_item' => __( 'Salvar Tipo' ),
    'add_new_item' => __( 'Adicionar Novo' ),
    'new_item_name' => __( 'Nome' ),
    'menu_name' => __( 'Tipos' ),
  ); 	

// Now register the taxonomy

  register_taxonomy('tipos',array('produtos'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tipo' ),
  ));

}