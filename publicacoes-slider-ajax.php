<?php
function _thumb() {
	if ( has_post_thumbnail() ) {
		return get_the_post_thumbnail( 'slider-publicacoes-image' );
	} else {
		return '<img src="http://placehold.it/151x228" />';
	}

}

function wp_bootstrap_carousel( $args = '', $visible = 3, $active = 0 ) {
// cannot show more than 12 items at once
	if ( ! intval( $visible ) || $visible > 12 ) {
		return false;
	}
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		$i      = - 1;
		$output = '';
		// calculate the span class depending on desired visible items
		$span = floor( 12 / $visible );
		// if 12 is not a perfect multiple of visible items, calculate the residue
		$span_residue = 12 % $visible;
		$slides       = 0;
		while ( $query->have_posts() ) :
			$i ++;
			$query->the_post();
			// set active only the desired active item
			$item_class = $i == $active ? 'item active' : 'item';
			$u          = ( ( $i == 0 ) || $i % ( $visible ) == 0 ) ? 0 : $u + 1;
			if ( $u == 0 ) {
				$slides ++;
				// open item div if needed
				$output .= '<div class="' . $item_class . '">';
			}
			$output .= '<a class="col-md-' . $span . '" href="' . get_permalink() . '">' . _thumb() . '</a>';
			// close item div if needed
			if ( $u == ( $visible - 1 ) || $i == ( $query->post_count - 1 ) ) {
				// when on last post we always need to close the current item div,
				// if total is not divisible by visible we insert a "fake" item
				if ( $u != ( $visible - 1 ) ) {
					$span_residue += ( ( $visible - 1 ) - $u ) * $span;
				}
				if ( $span_residue > 0 ) {
					$output .= sprintf( '<div class="span%d">&nbsp;</div>', $span_residue );
				}
				$output .= '</div>';
			}
		endwhile;

		return array( 'items' => $output, 'total' => $query->post_count, 'slides' => $slides );
	}

	return false;
}
function slider() {
	if ( isset( $_GET['slider'] ) ) {
		$type = $_GET['slider'];
		$arg  = array(
			'post_type'      => array( 'publicacoes' ),
			'orderby'        => 'date',
			'order'          => 'ASC',
			'categorias'     => $type,
			'posts_per_page' => 16
		);?>
		<?php
		$carousel = wp_bootstrap_carousel( $arg, 4, 0 );
		echo $carousel['items'];
		echo 'ajax';
		die();
	}
}

add_action( 'init', 'slider', 1 );

?>
