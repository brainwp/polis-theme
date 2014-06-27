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
if(empty($categoria)){
    $categoria = $_GET['area'];
}
$anomin = (isset($_GET['anomin'])) ? $_GET['anomin'] : '';
$anomax = (isset($_GET['anomax'])) ? $_GET['anomax'] : '';
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
$args = array(
    'post_type' => 'publicacoes',
    'categorias' => $categoria,
    'tipos' => $tipo,
    's' => $key,
    'date_query' => $date_query,
    'posts_per_page' => $per_page,
    'paged' => $page,
);

// The Query
$query = new WP_Query($args);

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
// grab the current page number and set to 1 if no page number is set
$total_posts = $count;

// calculate the total number of pages.
$offset = $per_page * ($page - 1);
$total_pages = ceil($total_posts / $per_page);
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main biblioteca-main <?php echo $_GET['area'];?>" role="main">
        <?php get_template_part('inc/biblioteca', 'search-mini'); ?>
        <div class="col-md-3 <?php echo $_GET['area'];?>" id="ajax-biblioteca-sub-count">

        </div>

        <div class="col-md-9 right search-ctn">
            <div class="col-md-12 results">
                <?php $cat_info = get_term_by('slug', $_GET['area'], 'categorias'); ?>
                <?php if(!empty($key)): ?>
                    <span class="key">Resultados para '<?php echo $key;?>'</span>
                <?php endif; ?>
                <span class="area <?php echo $_GET['area'];?>">Em <?php echo $cat_info->name;?></span>
            </div>
            <?php
            $type_list = array();
            $type_add = array();

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $type_term = return_term_biblioteca('tipos');
                    if (!in_array(return_term_biblioteca('tipos'), $type_add)) { //verifique se vetor já existe no array
                        $type_add[] = $type_term;
                        $type_list[] = $type_term;
                        $type_list[$type_term][] = 0;
                        //$type_list[$type_term]['name'] = return_term_biblioteca_name('categorias');
                    }
                    $_i = count($type_list[$type_term]);

                    $type_list[$type_term][$_i]['area'] = top_term('categorias', 'return_slug');
                    $type_list[$type_term][$_i]['area_sub'] = child_term('categorias', 'return');
                    $type_list[$type_term][$_i]['term_name'] = return_term_biblioteca_name('tipos');
                    $type_list[$type_term][$_i]['term_slug'] = return_term_biblioteca('tipos');
                    $type_list[$type_term][$_i]['title'] = get_the_title();
                    $type_list[$type_term][$_i]['resumo'] = resumo(150, '...');
                    $type_list[$type_term][$_i]['id'] = get_the_id();
                    $type_list[$type_term][$_i]['link'] = get_permalink();
                    $type_list[$type_term][$_i]['autor'] = get_the_author_meta('display_name');
                    $type_list[$type_term][$_i]['autor_user'] = strtolower(get_the_author_link('user_login'));
                    $type_list[$type_term][$_i]['tipos'] = escape_terms('tipos', 'name');
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
                        'hide_empty' => 1,
                        'hierarchical' => 1,
                        'taxonomy' => 'tipos',
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
                    <div class="tab-pane" id="tab-<?php echo $slug[$i]['term_slug'] ?>"
                         data-nav="tab-nav-<?php echo $slug[$i]['term_slug'] ?>">
                        <?php
                        }
                        ?>
                        <div class="col-md-12 item" data-term-slug="<?php echo $slug[$i]['term_slug'] ?>">
                            <a href="<?php echo $slug[$i]['link'] ?>'" class="th">
                                <?php
                                if (has_post_thumbnail($slug[$i]['id'])) {
                                    echo get_the_post_thumbnail($slug[$i]['id'], 'busca-thumb');
                                } else {
                                    echo '<img src="http://placehold.it/87x130">';
                                }
                                ?>
                            </a>

                            <div class="col-md-5 search_title">
                                <div class="col-md-12">
                                    <a class="titulo"
                                       href="<?php echo $slug[$i]['title']; ?>"><?php echo $slug[$i]['title']; ?></a>
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
                            <div class="col-md-10 infos">
                                <a class="autor"
                                   href="<?php echo get_home_url() . '/equipe/' . $slug[$i]['autor_user']; ?>">Por <?php echo $slug[$i]['autor']; ?></a>
                                <a class="autor-sep">• <?php echo $slug[$i]['tipos']; ?></a>
                                <a class="autor-sep">• <?php echo $slug[$i]['data']; ?></a>

                                <div class="pull-right download">
                                    <?php
                                    if (!empty($slug[$i]['downloadid'])):
                                        ?>
                                        <a href="<?php echo wp_get_attachment_url($slug[$i]['downloadid']); ?>"
                                           download>
                                            <img src="<?php bloginfo('template_url'); ?>/img/biblioteca-dl.png">
                                            Download
                                        </a>
                                        <span>|</span>
                                    <?php
                                    endif;
                                    ?>
                                    <a href="<?php echo $slug[$i]['link']; ?>">
                                        Leia Mais
                                    </a>
                                </div>
                            </div>
                        </div>

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
                echo 'nenhum post encontrado nessa pesquisa';
            }
            ?>
            <div class="container pagination">
                <div class="col-md-4 col-md-offset-4">
                    <?php
                    $search_vars = '/?key=' . $key . '&tipo=' . $tipo . '&categoria=' . $categoria . '&area=' . $_GET['area'] . '&anomin=' . $anomin . '&anomax=' . $anomax . '';
                    if ($page != 1) {
                        ?>
                        <a href="<?php echo get_bloginfo('url') ?>/biblioteca/busca/page/<?php echo $page - 1 . $search_vars ?>/">
                            &lt;</a>
                    <?php
                    }
                    ?>
                    <?php
                    for ($i = 1; $i < $total_pages + 1; $i++) {
                        if ($i == $page) {
                            echo '<a class="atual" href="' . get_bloginfo('url') . '/biblioteca/busca/page/' . $i . $search_vars . '">' . $i . '</a>';
                        } else {
                            echo '<a href="' . get_bloginfo('url') . '/biblioteca/busca/page/' . $i . $search_vars . '">' . $i . '</a>';
                        }
                    }
                    ?>
                    <?php
                    if ($page < $total_pages) {
                        ?>
                        <a href="<?php echo get_bloginfo('url') ?>/biblioteca/busca/page/<?php echo $page + 1 . $search_vars ?>">
                            &gt;</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
    </main>
</div>
<?php
get_footer();
?>