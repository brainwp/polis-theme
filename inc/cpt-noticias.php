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
	    'menu_position' => null,
	    'supports' => array('title','author','editor','excerpt','thumbnail','post-formats', 'taxonomy')
	    )
    );

	flush_rewrite_rules();

}
   
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_taxonomies_noticias', 0 );

function create_taxonomies_noticias() {
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
   
// Adiciona a coluna Categorias ao Custom Post Type colecoes
add_filter( 'manage_noticias_posts_columns', 'noticias_cpt_columns' );
add_action( 'manage_noticias_posts_custom_column', 'noticias_cpt_custom_column', 10, 2 );

function noticias_cpt_columns( $defaults ) {
    $defaults['categorias'] = 'Categorias';
    return $defaults;
}

function noticias_cpt_custom_column( $column_name, $post_id ) {
    $taxonomy = $column_name;
    $post_type = get_post_type( $post_id );
    $terms = get_the_terms( $post_id, $taxonomy );
 
    if ( !empty($terms) ) {
        foreach ( $terms as $term )
            $post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
        echo join( ', ', $post_terms );
    }
    else echo '<i>Sem Categorias.</i>';
}