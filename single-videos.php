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

get_header(); ?>

    <section class="col-md-12 content videos">

        <?php while ( have_posts() ) : the_post(); ?>

            <article class="col-md-8 pull-left content-page">
                <h1><span class="cinza">Vídeo:</span> <?php the_title(); ?></h1>

                <?php
                    if ( has_post_thumbnail() ) {
                        $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
                        echo '<div class="thumb">';
                        echo '<img src="' . $thumb_url[0] . '"/>';
                        echo '</div>';
                    }
                ?>

                <?php the_content(); ?>

                <?php
                    $video = get_field( 'url_do_video' );
                    if( ! empty( $video ) ) : ?>
                    <div class="video">
                        <?php echo apply_filters( 'the_content', $video ); ?>
                    </div>
                <?php endif; ?>

                <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() ) : ?>
                        <div class="comentarios">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif;
                ?>

            </article>

            <aside class="col-md-4 pull-right sidebar-page">
                <?php if ( is_active_sidebar( 'widgets-institucional' ) ) : ?>
                    <?php dynamic_sidebar( 'widgets-institucional' ); ?>
                <?php endif; ?>
            </aside>

        <?php endwhile; // end of the loop. ?>

    </section>

<?php get_footer(); ?>