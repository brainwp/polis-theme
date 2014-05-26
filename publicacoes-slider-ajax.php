<?php
function slider() {
	if ( isset( $_GET['slider'] ) ) {
		$type = $_GET['slider'];
		if ( $type == 'todas' ) {
			$arg = array(
				'post_type'      => array( 'publicacoes' ),
				'orderby'        => 'date',
				'order'          => 'ASC',
				'posts_per_page' => 15
			);
		} else {
			$arg = array(
				'post_type'      => array( 'publicacoes' ),
				'orderby'        => 'date',
				'order'          => 'ASC',
				'categorias'     => $type,
				'posts_per_page' => 15
			);
		};?>
		<?php
		$publicacoes = new WP_Query( $arg ); ?>
		<?php while ( $publicacoes->have_posts() ) :
			$publicacoes->the_post(); ?>
			<li class="ajax-item">
				<a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'slider-publicacoes-image' );
					} else {
						echo '<img src="http://placehold.it/151x228" />';
					}
					?>
				</a>
			</li>
		<?php endwhile; ?>
		<?php
		die();
	}
}

add_action( 'init', 'slider', 1 );

?>
