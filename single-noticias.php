<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Polis Theme
 */

get_header(); ?>

	<section class="col-md-12 content-single-areas <?php top_term( 'categorias', 'slug' ); ?>">

		<?php while ( have_posts() ) : the_post(); ?>

		<?php $categoria = top_term( 'categorias', 'return' ); ?>

		<header>

			<?php if ( empty( $categoria ) ) { ?>
				<h1><?php cpt_name(); ?></h1></span>
			<?php } else { ?>
				<h1><?php echo $categoria; ?></h1><span class="marcador">•</span><span><?php cpt_name(); ?></span>
			<?php } ?>

		</header><!-- header -->

		<article class="col-md-12 pull-left">
			<div class="thumb">
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'slider-publicacoes-thumb' );
				} else { ?>
					<img src="<?php echo get_template_directory_uri(); ?>/img/default-publicacoes-thumb.jpg" alt="<?php the_title(); ?>" />
				<?php } ?>
			</div><!-- thumb -->

			<div class="content">
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
				<div class="meta">
					<?php if( get_field('mgr_fonte') ): ?>
						<span>Fonte: <?php echo get_field( 'mgr_fonte' ); ?></span><br>
					<?php endif; ?>

					<?php if( get_field('mgr_link_externo') ): ?>
						<span>Link Externo: <?php echo get_field( 'mgr_link_externo' ); ?></span><br>
					<?php endif; ?>

					<?php if( get_field('mgr_autor') ): ?>
						<span>Autor: <?php echo get_field( 'mgr_autor' ); ?></span><br>
					<?php endif; ?>
				</div><!-- meta -->
			</div><!-- content -->

		</article>

		<?php endwhile; // end of the loop. ?>

    </section>

    <section class="col-md-12 slider-single-areas <?php top_term( 'categorias', 'slug' ); ?>">

    	<?php
			$terms_c = array();
			$terms_c = escape_terms( 'tipos' );
    	?>

    	<h2>Outras Notícias em <?php echo $terms_c; ?></h2>

    	<div id="carousel" class="col-md-12 list_carousel responsive">
			<?php
			$arg = array(
				'post_type'			=> array( 'noticias' ),
				'tipos'				=> $terms_c,
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

<?php get_footer(); ?>