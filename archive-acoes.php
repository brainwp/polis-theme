<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17/07/14
 * Time: 14:39
 */
global $wp_query;
get_header();?>

    <section class="col-md-12 content perfil projetos-main cpt-acoes">
        <div class="header-area col-md-12">
            <h1>Ações</h1>
        </div>
        <div class="col-md-5 intro <?php echo $_query->area_slug ?>">
            <span>Todas Ações</span>
        </div>
    </section>
    <section class="col-md-12 atividades archive-publicacoes">
            <ul class="list_carousel">
                <?php $count = ''; ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="col-md-3">
                        <?php get_template_part('area-slider', 'acoes'); ?>
                    </div>
                <?php endwhile;
                else: ?>
                <?php endif; ?>
            </ul>
        <div class="container pagination">
            <div class="col-md-4 col-md-offset-4">
                <?php
                $page = (get_query_var('paged')) ? get_query_var('paged') : 1;

                $total = $wp_query->max_num_pages;
                $big = 999999999; // need an unlikely integer
                if ($total > 1) {
                    if (!$current_page = $page)
                        $current_page = 1;
                    $format = 'page/%#%/';
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => $format,
                        'current' => max(1, $page),
                        'total' => $total,
                        'mid_size' => 3,
                        'type' => 'list',
                        'prev_text' => '<',
                        'next_text' => '>',
                    ));
                }
                ?>
            </div>
        </div>
    </section>
<?php
get_footer();
?>