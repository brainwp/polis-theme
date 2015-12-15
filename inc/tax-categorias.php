<?php
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_taxonomies_categorias', 0 );

function create_taxonomies_categorias() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categorias', 'taxonomy general name' ),
		'singular_name'     => _x( 'Categoria', 'taxonomy singular name' ),
		'search_items'      => __( 'Procurar Categoria' ),
		'all_items'         => __( 'Todas Categorias' ),
		'view_item'  	    => __( 'Ver Categorias' ),
		'parent_item'       => __( 'Categoria pai' ),
		'parent_item_colon' => __( 'Categoria pai:' ),
		'edit_item'         => __( 'Editar Categoria' ),
		'update_item'       => __( 'Salvar Categoria' ),
		'add_new_item'      => __( 'Adicionar Nova' ),
		'new_item_name'     => __( 'Nova' ),
		'menu_name'         => __( 'Categorias' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'categoria' ),
	);

	register_taxonomy( 'categorias', array( 'noticias','publicacoes','acoes' ), $args );

}