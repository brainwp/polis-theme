<?php
function areaAjax() {
	if ( isset( $_GET['areaAjax'] ) && isset( $_GET['areaCatAjax'] ) && isset( $_GET['areaSlider'] ) ) {
		$area   = $_GET['areaAjax'];
		$slider = $_GET['areaSlider'];
		$cat    = $_GET['areaCatAjax'];
		if ( $slider == 'noticias' ):
			?>
			<?php
			$args     = array(
				'post_type' => 'noticias',
				'tax_query' => array(
					array(
						'taxonomy'         => 'categorias',
						'field'            => 'id',
						'terms'            => $cat,
						'include_children' => true,
						'posts_per_page'   => 8,
					)
				)
			);
			$noticias = new WP_Query( $args ); // exclude category
			while ( $noticias->have_posts() ) : $noticias->the_post(); ?>
				<li class="item ajax-item-noticias">
					<a href="<?php the_permalink(); ?>">
						<?php $terms = terms( 'categorias' ); ?>
						<?php $terms = explode( ',', $terms ); ?>
						<?php
						if ( has_post_thumbnail() ) {
							$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-publicacoes-image', true );
							echo '<img src="' . $thumb_url[0] . '"/>';
						} else {
							echo '<img src="' . theme( '/img/default-publicacoes-thumb.jpg' ) . '"/>';
						}
						?>
						<div class="caption-container">
							<small class="caption"><?php echo $terms[0]; ?></small>
						</div>
						<h2 class="title"><?php the_title(); ?></h2>

						<div class="col-md-12 resumo"><?php echo resumo(); ?></div>
					</a>
				</li>

			<?php endwhile; ?>
		<?php endif; ?>
		<?php
		if ( $slider == 'publicacoes' ):
			?>
			<?php
			$args        = array(
				'post_type' => 'publicacoes',
				'tax_query' => array(
					array(
						'taxonomy'         => 'categorias',
						'field'            => 'id',
						'terms'            => $cat,
						'include_children' => true,
						'posts_per_page'   => 10,
					)
				)
			);
			$publicacoes = new WP_Query( $args ); ?>
			<?php while ( $publicacoes->have_posts() ) :
			$publicacoes->the_post(); ?>
			<li class="item ajax-item-publicacoes">
				<a href="<?php the_permalink(); ?>">

					<div class="hover"></div>

					<?php
					if ( has_post_thumbnail() ) {
						$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-publicacoes-image', true );
						echo '<img src="' . $thumb_url[0] . '"/>';
					} else {
						echo '<img src="' . theme( '/img/default-publicacoes-thumb.jpg' ) . '" />';
					}
					?>
				</a>
			</li>

		<?php endwhile; ?>
		<?php endif; ?>
		<?php
		if ( $slider == 'acoes' ):
			?>
			<?php
			$args     = array(
				'post_type' => 'acoes',
				'tax_query' => array(
					array(
						'taxonomy'         => 'categorias',
						'field'            => 'id',
						'terms'            => $cat,
						'include_children' => true,
						'posts_per_page'   => 10,
					)
				)
			);
			$noticias = new WP_Query( $args ); // exclude category
			while ( $noticias->have_posts() ) : $noticias->the_post(); ?>
				<li class="item ajax-item-acoes">
					<a href="<?php the_permalink(); ?>" class="post">
						<div class="post_container">
							<div class="thumb">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'medium' );
								} else {
									echo '<img src="' . theme() . '/img/thumb-equipe.png">';
								} ?>
								<h3><?php the_title(); ?></h3>
							</div>
							<!-- thumb -->

							<div class="col-md-12 description">
								<?php echo resumo( 150 ); ?>
								<span class="leia" href="<?php the_permalink(); ?>">Leia mais</span>
							</div>
						</div>
						<!-- post_container -->
					</a>
				</li>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php
		die();
	}
}

add_action( 'init', 'areaAjax', 1 );

?>
