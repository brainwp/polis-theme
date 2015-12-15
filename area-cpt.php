<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 29/07/14
 * Time: 19:21
 */
global $wp_query, $_query;

$current_class = $_query->area;
$term = get_term_by('slug', $current_class, 'areas');
$name_term = $term->name;
$description_term = $term->description;
$_cpt = get_post_type_object($_query->cpt);
get_header();?>

    <div id="primary" class="content-area">

        <main id="main" class="site-main area-main <?php echo $current_class; ?>" role="main"
              data-slug="<?php echo $current_class; ?>">

            <div id="hide-ajax" style="display: none"></div>

            <div class="header-area <?php echo $current_class; ?>">

                <div class="left col-md-2">
                    <h1><?php echo $name_term; ?>/<?php echo $_cpt->labels->name; ?></h1>
                    <span class="rm-mob"><?php echo $description_term; ?></span>
                </div>
                <!-- .left -->

                <div class="col-md-2 pull-right areas">
                    <?php outras_areas_cpt(); ?>
                </div>
                <!-- rigtht -->


            </div>
            <section class="col-md-12 atividades archive-publicacoes">
                <ul class="list_carousel">
                    <?php $count = ''; ?>
                    <?php if ($_query->query->have_posts()) : while ($_query->query->have_posts()) : $_query->query->the_post(); ?>
                        <div class="col-md-3">
                            <?php get_template_part('area-slider', $_query->cpt); ?>
                        </div>
                    <?php endwhile;
                    else: ?>

                    <?php endif; ?>
                </ul>
                <div class="container pagination">
                    <div class="col-md-4 col-md-offset-4">
                        <?php
                        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        $total = $_query->query->max_num_pages;
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
        </main>
    </div>
<?php
get_footer();
?>