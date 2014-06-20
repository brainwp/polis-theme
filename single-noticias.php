<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Polis Theme
 */

get_header(); ?>

	<section class="col-md-12 content-single <?php top_term( 'categorias', 'slug' ); ?>">

		<?php while ( have_posts() ) : the_post(); ?>

		<article class="col-md-8 pull-left">
			<h1><?php the_title(); ?></h1>
			
			<div class="thumb">
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'single-noticias-thumb' );
				} else { ?>
					<img src="<?php echo get_template_directory_uri(); ?>/img/default700x200.jpg" alt="<?php the_title(); ?>" />
				<?php } ?>
				<?php $terms = terms( 'categorias' ); ?>
				<?php $class_term = explode(", ", $terms); ?>
				<div class="news-terms bg-<?php echo sanitize_title($class_term[0]); ?>">
					<?php echo $terms; ?>
				</div>
			</div><!-- thumb -->

			<?php the_content(); ?>
		</article>
		<aside class="col-md-4 pull-right sidebar-page">
			<?php if ( is_active_sidebar( 'widgets-institucional' ) ) : ?>
				<?php dynamic_sidebar( 'widgets-institucional' ); ?>
			<?php endif; ?>
		</aside>

		<?php endwhile; // end of the loop. ?>

    </section>

	<?php
		$terms_c = array();
		$terms_c = terms( 'categorias' );
		$terms_e = escape_terms( 'categorias' )
	?>

<?php if ( ! empty( $terms_c ) ): ?>

	<section class="col-md-12 slider-single-areas <?php top_term( 'categorias', 'slug' ); ?>">

    	<h2>Outras Notícias<?php if ( ! empty( $terms_c ) ): ?> em <?php echo $terms_c; ?><?php endif; ?></h2>

    	<div id="carousel" class="col-md-12 list_carousel responsive">
			<?php
			$arg = array(
				'post_type'			=> array( 'noticias' ),
				'tipos'				=> $terms_e,
				'orderby'			=> 'date',
				'order'				=> 'ASC',
				'posts_per_page'	=> 15
			);?>
			<ul id="slider2">
				<?php
				$publicacoes = new WP_Query( $arg ); ?>
				<?php while ( $publicacoes->have_posts() ) :
					$publicacoes->the_post(); ?>
					<li class="item">
						<a href="<?php the_permalink(); ?>">

							<div class="hover"></div>

							<?php
							if ( has_post_thumbnail() ) {
								$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-publicacoes-thumb', true );
								echo '<img src="' . $thumb_url[0] . '"/>';
							} else {
								echo '<img src="'. theme('/img/default-publicacoes-thumb.jpg') .'" />';
							}
							?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
		</div><!-- carousel -->

		<div id="prev-publicacao" class="prev"></div>
		<div id="next-publicacao" class="next"></div>

		<div class="clear"></div>

    </section>

<?php endif; ?>

<?php get_footer(); ?>