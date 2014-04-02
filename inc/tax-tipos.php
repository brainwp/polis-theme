<?php
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_taxonomies_tipos', 0 );

function create_taxonomies_tipos() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Tipos', 'taxonomy general name' ),
		'singular_name'     => _x( 'Tipo', 'taxonomy singular name' ),
		'search_items'      => __( 'Procurar Tipo' ),
		'all_items'         => __( 'Todos Tipos' ),
		'view_item'  	    => __( 'Ver Tipos' ),
		'parent_item'       => __( 'Tipo pai' ),
		'parent_item_colon' => __( 'Tipo pai:' ),
		'edit_item'         => __( 'Editar Tipo' ),
		'update_item'       => __( 'Salvar Tipo' ),
		'add_new_item'      => __( 'Adicionar Tipo' ),
		'new_item_name'     => __( 'Novo' ),
		'menu_name'         => __( 'Tipos' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tipo' ),
	);

	register_taxonomy( 'tipos', array( 'noticias','publicacoes' ), $args );
}