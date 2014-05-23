<?php
function slider() {
	if ( isset( $_GET['slider'] ) ) {
		$type = $_GET['slider'];;?>
		<?php $arg = array(
			'post_type'      => array( 'publicacoes' ),
			'orderby'        => 'date',
			'order'          => 'ASC',
			'categorias'     => $type,
			'posts_per_page' => 4
		);?>
		<?php
		$publicacoes = new WP_Query( $arg ); ?>
		<div class="item active">
			<?php while ( $publicacoes->have_posts() ) :
				$publicacoes->the_post(); ?>
				<a class="col-md-3" href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'slider-publicacoes-image' );
					} else {
						echo '<img src="http://placehold.it/151x228" />';
					}
					?>
				</a>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
		<?php $arg = array(
			'post_type'      => array( 'publicacoes' ),
			'orderby'        => 'date',
			'order'          => 'ASC',
			'categorias'     => $type,
			'posts_per_page' => 4,
			'offset'         => 4
		);?>
		<?php
		$publicacoes = new WP_Query( $arg ); ?>
		<div class="item">
			<?php while ( $publicacoes->have_posts() ) :
				$publicacoes->the_post(); ?>
				<a class="col-md-3" href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'slider-publicacoes-image' );
					} else {
						echo '<img src="http://placehold.it/151x228" />';
					}
					?>
				</a>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
		<?php $arg = array(
			'post_type'      => array( 'publicacoes' ),
			'orderby'        => 'date',
			'order'          => 'ASC',
			'categorias'     => $type,
			'posts_per_page' => 4,
			'offset'         => 8
		);?>
		<?php
		$publicacoes = new WP_Query( $arg ); ?>
		<div class="item">
			<?php while ( $publicacoes->have_posts() ) :
				$publicacoes->the_post(); ?>
				<a class="col-md-3" href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'slider-publicacoes-image' );
					} else {
						echo '<img src="http://placehold.it/151x228" />';
					}
					?>
				</a>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
		<?php
		die();
	}
}

add_action( 'init', 'slider', 1 );

?>
