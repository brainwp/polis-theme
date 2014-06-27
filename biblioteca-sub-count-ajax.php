<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/06/14
 * Time: 11:34
 */
function AjaxSubCount(){
    if (isset($_GET['isAjaxSubCount']) && $_GET['area']) {

        $key = (isset($_GET['key'])) ? $_GET['key'] : '';
        $formato = (isset($_GET['formato'])) ? $_GET['formato'] : '';
        if (empty($formato)) {
            $formato = array('publicacoes', 'acoes', 'noticias');
        }
        $tipo = (isset($_GET['tipo'])) ? $_GET['tipo'] : '';
        $anomin = (isset($_GET['anomin'])) ? $_GET['anomin'] : '';
        $anomax = (isset($_GET['anomax'])) ? $_GET['anomax'] : '';
        $area = $_GET['area'];
        $date_query = array();
        if (!empty($anomin) && !empty($anomax)) {
            $date_query = array(
                array(
                    'after' => array(
                        'year' => $anomin
                    ),
                    'before' => array(
                        'year' => $anomax,
                    ),
                )
            );
        } elseif (!empty($anomin) && empty($anomax)) {
            $date_query = array(
                array(
                    'after' => array(
                        'year' => $anomin
                    ),
                )
            );
        } elseif (!empty($anomax) && empty($anomin)) {
            $date_query = array(
                array(
                    'before' => array(
                        'year' => $anomax
                    ),
                )
            );
        }
        $_id = get_term_by('slug', $area, 'categorias');
        echo '<span>'.$_id->name.'</span>';
        $_id = $_id->term_id;
        $args = array(
            'parent'                 => $_id,
            'taxonomy'                 => 'categorias',
        );
        $categories = get_categories($args);
        foreach ($categories as $category) {
            // The Query
            $categoria = $category->slug;
            $count_args = array(
                'post_type' => 'publicacoes',
                'categorias' => $categoria,
                'tipos' => $tipo,
                's' => $key,
                'date_query' => $date_query,
                'post_per_page' => 999999,
            );
            $count_query = new WP_Query($count_args);
            $count = $count_query->found_posts;
            if($count > 0){
                echo '<a data-categoria="'.$category->slug.'" class="bt-categorias">'.$category->name . ' (' . $count . ')</a>';
            }
        }
        die();
    }
}
add_action( 'init', 'AjaxSubCount', 1 );
