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

	<section class="col-md-12 content">

		<?php while ( have_posts() ) : the_post(); ?>

		<article class="col-md-8 pull-left content-page">
			<ul class="nav nav-tabs tabs-idioma" role="tablist" >
                <li role="presentation" class="active" data-tab-element="#tab-ptbr"><a href="#tab-ptbr" role="tab" data-toggle="tab">Portugues do Brasil</a></li>
                <li role="presentation" data-tab-element="#tab-es"><a href="#tab-es" role="tab" data-toggle="tab">Espanhol</a></li>
                <li role="presentation" data-tab-element="#tab-en"><a href="#tab-en" role="tab" data-toggle="tab">Inglês</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tab-ptbr">
                    <h1><?php echo get_post_meta( get_the_ID(), 'title_ptbr', true ); ?></h1>
                    <?php
                        $content = get_post_meta( get_the_ID(), 'content_ptbr', true );
                        $content = apply_filters( 'the_content',  $content);
                        $content = str_replace( ']]>', ']]&gt;', $content );
                        echo $content;
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab-es">
                    <?php if( get_post_meta( get_the_ID(), 'active_es', true ) == 'true'): ?>
                        <h1><?php echo get_post_meta( get_the_ID(), 'title_es', true ); ?></h1>
                        <?php
                        $content = get_post_meta( get_the_ID(), 'content_es', true );
                        $content = apply_filters( 'the_content',  $content);
                        $content = str_replace( ']]>', ']]&gt;', $content );
                        echo $content;
                        ?>
                    <?php endif;?>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab-en">
                    <?php if( get_post_meta( get_the_ID(), 'active_en', true ) == 'true'): ?>
                        <h1><?php echo get_post_meta( get_the_ID(), 'title_en', true ); ?></h1>
                        <?php
                        $content = get_post_meta( get_the_ID(), 'content_en', true );
                        $content = apply_filters( 'the_content',  $content);
                        $content = str_replace( ']]>', ']]&gt;', $content );
                        echo $content;
                        ?>
                    <?php endif;?>
                </div>
            </div>
		</article>
		<aside class="col-md-4 pull-right sidebar-page">
			<?php if ( is_active_sidebar( 'widgets-institucional' ) ) : ?>
				<?php dynamic_sidebar( 'widgets-institucional' ); ?>
			<?php endif; ?>
		</aside>

		<?php endwhile; // end of the loop. ?>

    </section>

<?php get_footer(); ?>