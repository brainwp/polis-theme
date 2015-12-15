<?php global $_query; ?>
<?php get_header(); ?>

<?php
$current_term = get_term_by('slug', get_query_var('area'), 'areas');
$name_term = $current_term->name;
$description_term = $current_term->description;
$current_class = $current_term->slug;
$id = $current_term->term_id;

$args = array(
    'type' => array('acoes', 'noticias', 'publicacoes'),
    'child_of' => $id,
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 1,
    'hierarchical' => 1,
    //'exclude'      => 'formacao',
    'taxonomy' => 'areas',
    'pad_counts' => false
);

$categorias = get_categories($args);
// echo get_query_var( 'area' );
?>

    <div id="primary" class="content-area">

    <main id="main" class="site-main area-main <?php echo $current_class; ?>" role="main" data-slug="<?php echo $current_class; ?>">

    <div id="hide-ajax" style="display: none"></div>

    <div class="header-area <?php echo $current_class; ?>">

        <div class="left col-md-2">
            <h1><?php echo $name_term; ?></h1>
            <span class="rm-mob"><?php echo $description_term; ?></span>
        </div><!-- .left -->

        <div class="col-md-2 pull-right areas">
            <?php outras_areas(); ?>
        </div><!-- rigtht -->

    </div>

    <!-- .header-area -->

    <div id="ajax-publicacoes" class="hidden"></div>

    <div id="ajax-noticias" class="hidden"></div>

    <div id="ajax-acoes" class="hidden"></div>

    <div class="tabContaier">

    <ul>
        <?php $_i = 0; ?>
        <?php foreach ($categorias as $_categorias): ?>
            <li>
                <?php
                if ($_i == 0) {
                    $_first = $_categorias; ?>
                    <a class="tab-link active" data-id="<?php echo $_categorias->slug; ?>"
                       href="#area_<?php echo $_categorias->slug; ?>"><span><?php echo $_categorias->name; ?></span></a>

                <?php } else { ?>

                    <a class="tab-link" data-id="<?php echo $_categorias->slug; ?>"
                       href="#area_<?php echo $_categorias->slug; ?>"><span><?php echo $_categorias->name; ?></span></a>

                <?php } ?>

                <?php $_i++; ?>

            </li>

        <?php endforeach; ?>

    </ul>

    <!-- //Tab buttons -->

    <section class="col-md-12 tabDetails atividades">

    <?php $cat = $_first->slug; ?>

    <div id="first" data-first="<?php echo $cat; ?>" style="display:none"></div>

    <div id="area_<?php echo $_first->slug; ?>" class="tabContents aba-area">

        <!-- NOME E DESCRIÇÃO !-->
        <div class="col-md-12 description">
            <h1><?php echo $_first->name; ?></h1><a class="btn membros shape-todos" href="<?php echo home_url(); ?>/equipe/area/<?php echo $cat;?>">Equipe</a>
            <div class="clear"></div>
            <?php echo $_first->description; ?>
	        <div class="col-md-12 clear"></div>
        </div>

        <div class="cada-loop-aba publicacoes">

            <div class="section-title">
                <h3>Noticias</h3>
	            <a href="<?php echo home_url(); ?>/area/<?php echo $cat;?>/noticias" class="col-md-1 shape-todos">Ver todos</a>
            </div><!-- section-title -->

            <div class="col-md-12 list_carousel responsive noticias-slider">

                <?php
                // Loop Notícias
                $args = array(
                    'post_type' => 'noticias',
                    'posts_per_page'   => 10,
                    'orderby' => 'date',
                    'order'   => 'DESC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'areas',
                            'field' => 'slug',
                            'terms' => $cat,
                            'include_children' => true,
                        )
                    ),
                    'meta_query' => array(
                        array(
                            'key' => 'in_area_slider',
                            'value' => 'nao',
                            'compare' => '!='
                        ),
                    )
                );
                ?>

                <ul id="noticias-slider-<?php echo $cat; ?>" class="noticias">

                    <?php
                    $noticias = new WP_Query( $args );
                    while ( $noticias->have_posts() ) : $noticias->the_post();
                        ?>

                        <?php get_template_part('area-slider','noticias'); ?>

                    <?php endwhile; ?>

                </ul>

            </div>

            <div class="prev-slider noticias-prev-slider" id="noticias-prev-slider-<?php echo $cat; ?>"></div>

            <div class="next-slider noticias-next-slider" id="noticias-next-slider-<?php echo $cat; ?>"></div>

            <div class="clear"></div>

        </div>

        <!-- .cada-loop-aba -->


        <div class="cada-loop-aba publicacoes">

            <div class="section-title">
                <h3>Publicações</h3>
	            <a href="<?php echo home_url(); ?>/area/<?php echo $cat;?>/publicacoes" class="col-md-1 shape-todos">Ver todos</a>
            </div><!-- section-title -->

            <div class="col-md-12 list_carousel responsive">

                <?php
                // Loop Publicacoes
                $args = array(

                    'post_type' => 'publicacoes',
                    'posts_per_page'   => 10,
                    'orderby' => 'date',
                    'order'   => 'DESC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'areas',
                            'field' => 'slug',
                            'terms' => $cat,
                            'include_children' => true,
                        )
                    ),
                    'meta_query' => array(
                        array(
                            'key' => 'in_area_slider',
                            'value' => 'nao',
                            'compare' => '!='
                        ),
                    )
                );

                ?>

                <ul id="publicacoes-slider-<?php echo $cat; ?>" class="publicacoes-slider">

                    <?php $publicacoes = new WP_Query( $args ); ?>

                    <?php while ($publicacoes->have_posts()) :
                        $publicacoes->the_post(); ?>
                        <?php get_template_part('area-slider','publicacoes'); ?>
                    <?php endwhile; ?>

                </ul>

            </div>
            <div class="prev-slider acoes-prev-slider" id="publicacoes-prev-slider-<?php echo $cat; ?>"></div>
            <div class="next-slider acoes-next-slider" id="publicacoes-next-slider-<?php echo $cat; ?>"></div>

            <div class="clear"></div>

            <div class="todos-full">
                <a class="btn-todos-full" href="<?php echo home_url(); ?>/biblioteca">Veja todas as publicações ou faça uma busca</a>
            </div><!-- todos-full -->

            <?php // teste// ?>

        </div>

        <div class="cada-loop-aba acoes">

            <div class="section-title">
                <h3>Ações</h3>
	            <a href="<?php echo home_url(); ?>/area/<?php echo $cat;?>/acoes" class="col-md-1 shape-todos">Ver todos</a>
            </div><!-- section-title -->


            <div class="col-md-12 list_carousel responsive">

                <?php
                // Loop Ações
                $args = array(
                    'post_type' => 'acoes',
                    'posts_per_page'   => 10,
                    'orderby' => 'date',
                    'order'   => 'DESC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'areas',
                            'field' => 'slug',
                            'terms' => $cat,
                            'include_children' => true,
                        )
                    ),
                    'meta_query' => array(
                        array(
                            'key' => 'in_area_slider',
                            'value' => 'nao',
                            'compare' => '!='
                        ),
                    )
                );
                ?>
                <!-- Slider de Ações -->
                <ul id="acoes-slider-<?php echo $cat; ?>">

                    <?php
                    $acoes = new WP_Query( $args );
                    while ($acoes->have_posts()) : $acoes->the_post();
                        ?>
                        <?php get_template_part('area-slider','acoes'); ?>
                    <?php endwhile; ?>
                </ul>
            </div>

            <div class="prev-slider acoes-prev-slider" id="acoes-prev-slider-<?php echo $cat; ?>"></div>
            <div class="next-slider acoes-next-slider" id="acoes-next-slider-<?php echo $cat; ?>"></div>

            <div class="clear"></div>

        </div>

        <!-- .cada-loop-aba -->

    </div>

    <?php $_i = 0; ?>

    <?php foreach ($categorias as $_categorias): ?>

        <?php if ($_i != 0) {

            $cat = $_categorias->slug;

            ?>

            <div id="area_<?php echo $cat; ?>" class="tabContents aba-area">
                <!-- NOME E DESCRIÇÃO !-->
                <div class="col-md-12 description">
                    <h1><?php echo $_categorias->name; ?></h1><a class="btn membros shape-todos" href="<?php echo home_url(); ?>/equipe/area/<?php echo $cat;?>">Equipe</a>
                    <div class="clear"></div>
                    <?php echo $_categorias->description; ?>
	                <div class="col-md-12 clear"></div>
                </div>

                <div class="cada-loop-aba publicacoes">

                    <div class="section-title">

                        <h3>Noticias</h3>

                        <a href="<?php echo home_url(); ?>/area/<?php echo $cat;?>/noticias" class="col-md-1 shape-todos">Ver todos</a>

                    </div>

                    <div class="col-md-12 list_carousel responsive">

                        <ul id="noticias-slider-<?php echo $cat; ?>" class="noticias">

                        </ul>

                    </div>
                    <div class="prev-slider" id="noticias-prev-slider-<?php echo $cat; ?>"></div>
                    <div class="next-slider" id="noticias-next-slider-<?php echo $cat; ?>"></div>
                    <div class="clear"></div>

                </div>

                <!-- .cada-loop-aba -->

                <div class="cada-loop-aba publicacoes">

                    <div class="section-title">

                        <h3>Publicações</h3>

                        <a href="<?php echo home_url(); ?>/area/<?php echo $cat;?>/publicacoes" class="col-md-1 shape-todos">Ver todos</a>

                    </div>

                    <div class="col-md-12 list_carousel responsive">

                        <ul id="publicacoes-slider-<?php echo $cat; ?>" class="publicacoes-slider">

                        </ul>

                    </div>

                    <div class="prev-slider acoes-prev-slider" id="publicacoes-prev-slider-<?php echo $cat; ?>"></div>
                    <div class="next-slider acoes-next-slider" id="publicacoes-next-slider-<?php echo $cat; ?>"></div>

                    <div class="clear"></div>

                    <div class="todos-full">

                        <a class="btn-todos-full" href="<?php echo home_url(); ?>/biblioteca">Veja todas as publicações
                            ou faça uma busca</a>

                    </div>

                </div>

                <div class="cada-loop-aba publicacoes">
                    <div class="section-title">
                        <h3>Ações</h3>
                        <a href="<?php echo home_url(); ?>/area/<?php echo $cat;?>/acoes" class="col-md-1 shape-todos">Ver todos</a>
                    </div>

                    <div class="col-md-12 list_carousel responsive">
                        <ul id="acoes-slider-<?php echo $cat; ?>"></ul>
                    </div>

                    <div class="prev-slider" id="acoes-prev-slider-<?php echo $cat; ?>"></div>
                    <div class="next-slider" id="acoes-next-slider-<?php echo $cat; ?>"></div>
                    <div class="clear"></div>
                </div>

                <!-- .cada-loop-aba -->

            </div>

        <?php } ?>

        <?php $_i++; ?>

    <?php endforeach; ?>

    </section><!-- //tab Details -->
    </div><!-- //Tab Container -->
    </main><!-- #main -->
    </div><!-- #primary -->

<?php get_footer(); ?>