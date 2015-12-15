<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 10/06/14
 * Time: 09:42
 */
if (!isset($_GET['area'])) {
    header('Location: ' . get_bloginfo('url') . '/biblioteca'); //redireciona de volta a página de busca caso a area não tenha sido escolhida
    die();
}
get_header('mini');
$per_page = of_get_option('biblioteca-busca-per-page');

$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$key = (isset($_GET['key'])) ? $_GET['key'] : '';
$tipo = (isset($_GET['tipo'])) ? $_GET['tipo'] : '';
$categoria = (isset($_GET['categoria'])) ? $_GET['categoria'] : '';
if (empty($categoria)) {
    $categoria = $_GET['area'];
}
$anomin = (isset($_GET['anomin'])) ? $_GET['anomin'] : '';
$anomax = (isset($_GET['anomax'])) ? $_GET['anomax'] : '';
$date_query = array();
if (!empty($anomin) && !empty($anomax)) {
    $date_query = array(
        array(
            'after' => array(
                'year' => (int) $anomin,
                'month' => 12
                ),
            'before' => array(
                'year' => (int) $anomax,
                'month' => 12
                ),
            )
        );
} elseif (!empty($anomin) && empty($anomax)) {
    $date_query = array(
        array(
            'after' => array(
                'year' => (int) $anomin,
                'month' => 12
                ),
            )
        );
} elseif (!empty($anomax) && empty($anomin)) {
    $date_query = array(
        array(
            'before' => array(
                'year' => (int) $anomax,
                'month' => 12
                ),
            )
        );
}
$args = array(
    'post_type' => 'publicacoes',
    'areas' => $categoria,
    'tipos' => $tipo,
    's' => $key,
    'date_query' => $date_query,
    'posts_per_page' => $per_page,
    'paged' => $page,
    );
if ( !is_user_logged_in() || !check_user_role('administrator') && !check_user_role('editor') && !check_user_role('pesquisador') ) {
    $args = array(
        'post_type' => 'publicacoes',
        'areas' => $categoria,
        'tipos' => $tipo,
        's' => $key,
        'date_query' => $date_query,
        'posts_per_page' => $per_page,
        'paged' => $page,
        'meta_query' => array(
            array(
                'key'     => 'publicacoes_qual_tipo',
                'value'   => 'arquivistica',
                'compare' => 'NOT LIKE',
                ),
            ),
        );
}
if ( is_user_logged_in() && check_user_role('administrator') ) {
    $args['post_status'] = array('publish','private');
}
if ( is_user_logged_in() && check_user_role('editor') ) {
    $args['post_status'] = array('publish','private');
}
if ( is_user_logged_in() && check_user_role('pesquisador') ) {
    $args['post_status'] = array('publish','private');
}
$query = new WP_Query($args);
//echo 'QUERY - '. $query->found_posts . '<br><br>';
//global $wpdb;
//$pageposts = $wpdb->get_results($_sql, OBJECT);
// Print last SQL query string
//echo $wpdb->last_query . '<br>';
// Print last SQL query result
//echo var_dump($wpdb->last_result);
// Print last SQL query Error
//echo $wpdb->last_error . '<br>';


$count_args = array(
    'post_type' => 'publicacoes',
    'areas' => $categoria,
    'tipos' => $tipo,
    's' => $key,
    'date_query' => $date_query,
    'post_per_page' => 999999,
    );
if ( !is_user_logged_in() || !check_user_role('administrator') && !check_user_role('pesquisador') ) {
    $count_args = array(
        'post_type' => 'publicacoes',
        'areas' => $categoria,
        'tipos' => $tipo,
        's' => $key,
        'date_query' => $date_query,
        'post_per_page' => 999999,
        'meta_query' => array(
            array(
                'key'     => 'publicacoes_qual_tipo',
                'value'   => 'arquivistica',
                'compare' => 'NOT LIKE',
                ),
            ),
        );
}
if ( is_user_logged_in() && check_user_role('administrator') ) {
    $count_args['post_status'] = array('publish','private');
}
if ( is_user_logged_in() && check_user_role('pesquisador') ) {
    $count_args['post_status'] = array('publish','private');
}
$count_query = new WP_Query($count_args);
$count = $count_query->found_posts;
//echo $count;
// grab the current page number and set to 1 if no page number is set
$total_posts = $count;

// calculate the total number of pages.
$offset = $per_page * ($page - 1);
$total_pages = ceil($total_posts / $per_page);
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main biblioteca-main <?php echo $_GET['area']; ?>" role="main">
        <?php get_template_part('inc/biblioteca', 'search-mini'); ?>
        <div class="clear-mob"></div>
        <div class="col-md-12 <?php echo $_GET['area']; ?>" id="ajax-biblioteca-sub-count">

        </div>
        <div class="col-md-12 search-ctn">

            <?php
            $type_list = array();
            $type_add = array();

            if ($query->have_posts() ){
                while ($query->have_posts()){
                    $query->the_post();
                    $type_term = return_term_biblioteca('categorias');
                    if (!in_array(return_term_biblioteca('categorias'), $type_add)) { //verifique se vetor já existe no array
                        $type_add[] = $type_term;
                        $type_list[] = $type_term;
                        $type_list[$type_term][] = 0;
                        //$type_list[$type_term]['name'] = return_term_biblioteca_name('categorias');
                    }
                    $_i = count($type_list[$type_term]);

                    $type_list[$type_term][$_i]['area'] = top_term('areas', 'return_slug');
                    $type_list[$type_term][$_i]['area_sub'] = child_term('areas', 'return');
                    $type_list[$type_term][$_i]['term_name'] = return_term_biblioteca_name('categorias');
                    $type_list[$type_term][$_i]['term_slug'] = return_term_biblioteca('categorias');
                    $type_list[$type_term][$_i]['title'] = get_the_title();
                    $type_list[$type_term][$_i]['resumo'] = resumo_publicacoes(400, '...');
                    $type_list[$type_term][$_i]['id'] = get_the_id();
                    $type_list[$type_term][$_i]['link'] = get_permalink();
                    $type_list[$type_term][$_i]['autor'] = get_the_author_meta('display_name');
                    $type_list[$type_term][$_i]['autor_user'] = strtolower(get_the_author_link('user_login'));
                    $type_list[$type_term][$_i]['tipos'] = escape_terms('categorias', 'name');
                    $type_list[$type_term][$_i]['data'] = get_the_date('d/m/Y');
                    $type_list[$type_term][$_i]['downloadid'] = get_campoPersonalizado('anexo');

                    $type_list[$type_term][$_i]++;
                }
                ?>
                <ul class="nav nav-tabs">
                    <?php
                    $_args = array(
                        'child_of' => 0,
                        'parent' => 0,
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'hide_empty' => 0,
                        'hierarchical' => 1,
                        'taxonomy' => 'categorias',
                        'pad_counts' => false
                        );
                    $categories = get_categories($_args);
                    foreach ($categories as $category) {
                        ?>
                        <li id="tab-nav-<?php echo $category->slug; ?>"
                            data-tab-element="#tab-<?php echo $category->slug; ?>">
                            <a href="#tab-<?php echo $category->slug; ?>"
                               data-toggle="tab"><?php echo $category->cat_name; ?></a>
                           </li>
                           <?php
                       }
                       ?>
                   </ul>
                   <div class="tab-content">
                    <?php
                    foreach ($type_list as $slug) {
                        for ($i = 1;
                            $i < count($slug);
                            $i++) {
                            if (trim($slug[$i]['term_slug']) == '') {
                                continue;
                            }
                            if ($i == 1) {
                                ?>
                                <div class="tab-pane <?php echo $_GET['area']; ?>" id="tab-<?php echo $slug[$i]['term_slug'] ?>"
                                 data-nav="tab-nav-<?php echo $slug[$i]['term_slug'] ?>">
                                 <?php
                             }
                             ?>
                             <div class="col-md-12 item" data-term-slug="<?php echo $slug[$i]['term_slug'] ?>">
                                <a href="<?php echo $slug[$i]['link'] ?>" class="th">
                                    <?php
                                    if (has_post_thumbnail($slug[$i]['id'])) {
                                        echo get_the_post_thumbnail($slug[$i]['id'], 'slider-publicacoes-thumb');
                                    } else {
                                        echo '<img width="160" height="240" src="'.get_bloginfo('template_url').'/img/default/thumb-default-publicacoes.jpg">';
                                    }
                                    ?>
                                </a>

                                <div class="col-md-4 search_title">
                                    <div class="col-md-12">
                                        <a class="titulo"
                                        href="<?php echo $slug[$i]['link']; ?>"><?php echo $slug[$i]['title']; ?></a>
                                    </div>
                                    <div class="col-md-12 bt-ctn">
                                        <?php
                                        if (!empty($slug[$i]['area_sub'])):
                                            ?>
                                        <a class="bt <?php echo $slug[$i]['area']; ?>"><?php echo $slug[$i]['area_sub']; ?></a>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-5 resumo">
                                    <a href="<?php echo $slug[$i]['link']; ?>"><?php echo $slug[$i]['resumo']; ?></a>
                                </div>
                                <div class="col-md-12 infos">
                                    <a class="autor"
                                    href="<?php echo get_home_url() . '/equipe/' . $slug[$i]['autor_user']; ?>">Por <?php echo $slug[$i]['autor']; ?></a>
                                    <a class="autor-sep">• <?php echo $slug[$i]['tipos']; ?></a>
                                    <a class="autor-sep">• <?php echo $slug[$i]['data']; ?></a>

                                    <div class="pull-right download">
                                        <?php if ( !empty( $slug[$i]['downloadid'] ) ) : ?>
                                            <a href="<?php echo wp_get_attachment_url($slug[$i]['downloadid']); ?>"
                                               download>
                                               <img src="<?php bloginfo('template_url'); ?>/img/biblioteca-dl.png">
                                               Download
                                            </a>
                                            <span>|</span>
                                        <?php endif; ?>
                                       <a href="<?php echo $slug[$i]['link']; ?>">Leia Mais</a>
                                </div><!-- download -->
                            </div><!-- infos -->
                            <div class="col-md-10 infos-mob">
                                <a href="<?php echo $slug[$i]['link'];?>">Mais informações</a>
                            </div>
                        </div>
                        <div class="clear-mob"></div>

                        <?php
                        if ($i == count($slug) - 1) {
                            echo '</div>'; //fecha a div da aba
                        }
                    }
                } ?>
            </div>
        </div>
        <?php
    } else {
        echo 'Nenhum post encontrado nessa pesquisa';
    }
    ?>
    <div class="container pagination">
        <div class="col-md-4 col-md-offset-4">
            <?php
            $search_vars = '/?key=' . $key . '&tipo=' . $tipo . '&categoria=' . $categoria . '&area=' . $_GET['area'] . '&anomin=' . $anomin . '&anomax=' . $anomax . '';

            $total = $total_pages;
                    $big = 999999999; // need an unlikely integer
                    if( $total > 1 )  {
                        if( !$current_page = $page )
                            $current_page = 1;
                        $format = 'page/%#%/'.$search_vars;
                        echo paginate_links(array(
                            'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format'		=> $format,
                            'current'		=> max( 1, $page ),
                            'total' 		=> $total,
                            'mid_size'		=> 3,
                            'type' 			=> 'list',
                            'prev_text'		=> '<',
                            'next_text'		=> '>',
                            ) );
                    }
                    ?>
                </div>
            </div>
        </main>
        <?php
        get_footer();
        ?>