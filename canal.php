<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Polis Theme
 */
global $_query;
get_header(); ?>


<div class="header-area col-md-12 header-area-canal">
	<h1>Canal Pólis</h1>
</div>

<section id="primary" class="content-area content-canal">
	<main id="main" class="site-main" role="main">

		<?php if ( $_query->canal->have_posts() ) : ?>

			<?php while ( $_query->canal->have_posts() ) : $_query->canal->the_post(); ?>

			<div class="each-video col-md-3">
				<div class="content">
                <a href="<?php the_permalink(); ?>">
                	<div class="thumb">
                    <?php
                    if (has_post_thumbnail()) {
                        $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider-publicacoes-image', true);
                        echo '<img src="' . $thumb_url[0] . '"/>';
                    } else {
                        echo '<img src="' . get_bloginfo('template_url') . '/img/default/thumb-default-videos.jpg"/>';
                    }
                    ?>
                </div><!-- .thumb -->
                    <div class="col-md-12 resumo">
                        <h2 class="title"><?php the_title(); ?></h2>
                    </div><!-- .resumo -->
                </a>
                </div>
			</div><!-- each-video -->

			<?php endwhile; ?>
             <div class="container pagination">
                <div class="col-md-4 col-md-offset-4">

                <?php
                $page = ( isset($_GET['pagina']) ) ? $_GET['pagina'] : 1;
                if ($_query->canal->max_num_pages > 1) {
                    echo paginate_links(array(
                        'format' => '?pagina=%#%',  
                        'current'   => max( 1, $page ),
                        'total' => $_query->canal->max_num_pages,
                        'type' => 'list',
                        'prev_text' => '<',
                        'next_text' => '>',
                    ));
                }
                ?>
                </div>
            </div>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>