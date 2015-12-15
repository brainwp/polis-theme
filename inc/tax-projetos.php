<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15/07/14
 * Time: 14:45
 */
// Register Custom Taxonomy
function register_projetos_tax() {

    $labels = array(
        'name'                       => 'Projetos',
        'singular_name'              => 'Projetos',
        'menu_name'                  => 'Tipos de projetos',
        'all_items'                  => 'Todos itens',
        'parent_item'                => 'Item parente',
        'parent_item_colon'          => 'Item parente:',
        'new_item_name'              => 'Adicionar novo tipo',
        'add_new_item'               => 'Adicionar novo tipo',
        'edit_item'                  => 'Editar item',
        'update_item'                => 'Atualizar item',
        'separate_items_with_commas' => 'Separe os itens com virgula',
        'search_items'               => 'Buscar itens',
        'add_or_remove_items'        => 'Adicionar ou remover',
        'choose_from_most_used'      => 'Escolher entre os mais usados',
        'not_found'                  => 'Não encontrado',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'projetos_tax', array( 'projetos' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_projetos_tax', 0 );
