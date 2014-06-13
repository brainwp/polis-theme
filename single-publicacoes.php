<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Polis Theme
 */

get_header(); ?>

	<section class="col-md-12 content-single-areas <?php top_term( 'categorias', 'slug' ); ?>">

		<?php while ( have_posts() ) : the_post(); ?>

		<header>
			<h1><?php top_term( 'categorias' ); ?></h1><span class="marcador">•</span><span><?php cpt_name(); ?></span><span class="marcador">•</span><span><?php echo terms( 'tipos' ); ?></span>
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
					<?php if( get_field('publicacoes_autor') ): ?>
						<span>Autor: <?php echo get_field( 'publicacoes_autor' ); ?></span><br>
					<?php endif; ?>

					<?php if( get_field('publicacoes_ano') ): ?>
						<span>Ano: <?php echo get_field( 'publicacoes_ano' ); ?></span><br>
					<?php endif; ?>

					<?php if( get_field('publicacoes_paginas') ): ?>
						<span>Páginas: <?php echo get_field( 'publicacoes_paginas' ); ?></span><br>
					<?php endif; ?>

					<?php if( get_field('publicacoes_download') ): ?>
						<?php
							$download = get_field('publicacoes_download');
							$file = substr( $download['url'], strrpos( $download['url'], '/' ) +1 );
							$size = number_format( filesize( get_attached_file( $download['id'] ) ) / 1048576, 2 ) . "mb";
						?>
						<a class="btn bg-<?php top_term( 'categorias', 'slug' ); ?>" href="<?php echo $download['url']; ?>" download="<?php echo $file; ?>">Download <?php echo $size; ?></a>
					<?php endif; ?>
				</div><!-- meta -->
			</div><!-- content -->

		</article>

		<?php endwhile; // end of the loop. ?>

    </section>

    <section class="col-md-12 slider-single-areas <?php top_term( 'categorias', 'slug' ); ?>">

    	<h2>Outros <?php echo terms( 'tipos' ); ?></h2>

    	<div id="carousel" class="col-md-12 list_carousel responsive">
			<?php
			$terms_c = array();
			$terms_c = escape_terms( 'tipos' );
			$arg = array(
				'post_type'			=> array( 'publicacoes' ),
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

		<div class="todos-full"><a class="btn-todos-full" href="<?php echo home_url(); ?>/biblioteca">Veja todas as publicações ou faça uma busca</a></div>

    </section>


<?php get_footer(); ?>