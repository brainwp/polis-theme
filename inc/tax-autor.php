<?php

add_action( 'init', 'create_autor_taxonomies', 0 );

//create two taxonomies, genres and tags for the post type "tag"
function create_autor_taxonomies() 
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Autores do Documento', 'taxonomy general name' ),
    'singular_name' => _x( 'Autor', 'taxonomy singular name' ),
    'search_items' =>  __( 'Pesquisar Autores' ),
    'popular_items' => __( 'Autores Populares' ),
    'all_items' => __( 'Todos Autores' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar Autor' ), 
    'update_item' => __( 'Salvar Autor' ),
    'add_new_item' => __( 'Adicionar novo Autor' ),
    'new_item_name' => __( 'Nome do novo Autor' ),
    'separate_items_with_commas' => __( 'Separar Autores por vírgula' ),
    'add_or_remove_items' => __( 'Adicionar ou remover Autor' ),
    'choose_from_most_used' => __( 'Ver os Autores mais usados' ),
    'menu_name' => __( 'Autores' ),
  ); 

  register_taxonomy('autor','publicacoes',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'autor' ),
  ));
}

add_action( 'init', 'create_organizador_taxonomies', 0 );

//create two taxonomies, genres and tags for the post type "tag"
function create_organizador_taxonomies() 
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Organizadores/Coordenadores do Documento', 'taxonomy general name' ),
    'singular_name' => _x( 'Organizador/Coordenadores', 'taxonomy singular name' ),
    'search_items' =>  __( 'Pesquisar' ),
    'popular_items' => __( 'Mais populares' ),
    'all_items' => __( 'Todos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar' ), 
    'update_item' => __( 'Salvar' ),
    'add_new_item' => __( 'Adicionar novo' ),
    'new_item_name' => __( 'Nome' ),
    'separate_items_with_commas' => __( 'Separar Organizadores/Coordenadores por vírgula' ),
    'add_or_remove_items' => __( 'Adicionar ou remover' ),
    'choose_from_most_used' => __( 'Ver os Organizadores/Coordenadores mais usados' ),
    'menu_name' => __( 'Organizadores/Coordenadores' ),
  ); 

  register_taxonomy('organizador','publicacoes',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'organizador' ),
  ));
}