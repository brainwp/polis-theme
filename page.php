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
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
		<aside class="col-md-4 pull-right sidebar-page">
			<?php if ( is_active_sidebar( 'widgets-institucional' ) ) : ?>
				<?php dynamic_sidebar( 'widgets-institucional' ); ?>
			<?php endif; ?>
		</aside>

		<?php endwhile; // end of the loop. ?>

    </section>

<?php get_footer(); ?>