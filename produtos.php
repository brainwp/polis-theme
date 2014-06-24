<?php
/**
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package carpigiani-theme
 */
global $wp_query;
if ( ! isset( $_GET['p-type'] ) ) {
	get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="slider-content slider-content-produtos">
				<div class="entry-title-slider"><h1 class="entry-title">Produtos<?php //the_title(); ?></h1></div>
				<?php // get_template_part( 'content', 'produtos' ); ?>
			</section>
			<!-- #carousel .slider-content-single -->

			<section id="scroll" class="body-content body-content-produtos">
				<div class="wrap">

					<?php
					$args = array(
						'type'         => '',
						'child_of'     => 0,
						'parent'       => '',
						'orderby'      => 'ID',
						'order'        => 'ASC',
						'hide_empty'   => 0,
						'hierarchical' => 1,
						'exclude'      => '1',
						'include'      => '',
						'number'       => '4',
						'taxonomy'     => 'tipos',
						'pad_counts'   => false );

					$categories = get_categories( $args );

					foreach ( $categories as $category ) :
						$cat_ID = $category->term_id; // Get ID the category.
						// Get the URL of this category
						$category_link = get_category_link( $cat_ID );
						// Get the Slug of this category
						$category_slug = get_category_link( $category->slug );
						?>

						<div id="boxe" class="box" data-category="data-<?php echo $cat_ID; ?>">

							<div id="mdiv-<?php echo $cat_ID; ?>" class="cat-hover cat-hover-<?php echo $category->slug ?> mdiv">

								<a id="trick" class="trick trick-<?php echo $category->slug ?>" rel="<?php echo get_bloginfo( 'url' ) . '/produtos/?p-type=' . $category->slug; ?>" href="#scroll">
									<span class="cat-icon icon-<?php echo $category->slug ?>"></span>
									<span class="excerpt"><a rel="<?php echo esc_url( $category_link ); ?>"><?php echo $category->name; ?></a></span>
								</a>

							</div>
							<?php
							$child_args = array( 'child_of' => $cat_ID, 'hide_empty' => 0, );
							$child_categories = get_categories( $child_args );
							?>
						</div><!-- .box -->

					<?php endforeach; ?>

				</div>
				<!-- .wrap -->
			</section>
			<!-- .body-content-produtos -->
			<?php while ( have_posts() ) : the_post(); ?>
				<section id="cat-prod-container" class="cat-artesanal body-category-produtos" rel="<?php echo esc_url( $category_link ); ?>">
					<?php get_template_part( 'content', 'produtos' ); ?>
				</section><!-- .body-category-produtos -->
			<?php endwhile; // end of the loop. ?>

		</main>
		<!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
} else {
	?>
	<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
		<?php get_template_part( 'content', 'produtos' ); ?>
	<?php endwhile; // end of the loop. ?>
<?
}
?>