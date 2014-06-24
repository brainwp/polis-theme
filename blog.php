<?php
/**
 * The template for Blog
  * @package carpigiani-theme
 */
get_header(); ?>

	<div class="wrap-blog">
		<div id="primary" class="content-area blog">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<div class="each-post">
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<?php if ( has_post_thumbnail() ) : ?>
							<div class="thumb">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							</div><!-- .thumb -->
						<?php else : ?>
						<?php endif; ?>
						
						<?php the_excerpt(); ?>
						<div class="leia">
							<a href="<?php the_permalink(); ?>">Leia mais>></a>
						</div><!-- .leia -->
					</div><!-- .each-post -->

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	<?php get_sidebar(); ?>
	
	</div><!-- .wrap-blog -->

<?php get_footer(); ?>
