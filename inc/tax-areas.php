<?php
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_taxonomies_areas', 0 );

function create_taxonomies_areas() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Áreas', 'taxonomy general name' ),
		'singular_name'     => _x( 'Área', 'taxonomy singular name' ),
		'search_items'      => __( 'Procurar Área' ),
		'all_items'         => __( 'Todas Áreas' ),
		'view_item'  	    => __( 'Ver Área' ),
		'parent_item'       => __( 'Área pai' ),
		'parent_item_colon' => __( 'Área pai:' ),
		'edit_item'         => __( 'Editar Área' ),
		'update_item'       => __( 'Salvar Área' ),
		'add_new_item'      => __( 'Adicionar Nova' ),
		'new_item_name'     => __( 'Nova' ),
		'menu_name'         => __( 'Áreas' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'subarea' ),
	);

	register_taxonomy( 'areas', array( 'noticias','publicacoes','acoes' ), $args );

}