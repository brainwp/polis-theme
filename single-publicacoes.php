<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Polis Theme
 */

get_header(); ?>

	<section class="col-md-12 content-single-areas">

		<?php while ( have_posts() ) : the_post(); ?>

		<header>
			<h1><?php cpt_name(); ?></h1><span> • <?php top_term( 'categorias' ); ?></span><span> • <?php echo terms( 'tipos' ); ?></span>
		</header><!-- header -->

		<article class="col-md-12 pull-left">
			<div class="thumb">
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'slider-publicacoes-thumb' );
				} else { ?>
					<img src="<?php echo get_template_directory_uri(); ?>/img/default-publicacoes-thumb.jpg" alt="<?php the_title(); ?>" />
				<?php } ?>
			</div><!-- thumb -->
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</article>

		<?php endwhile; // end of the loop. ?>

    </section>

<?php get_footer(); ?>