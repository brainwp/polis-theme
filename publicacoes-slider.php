<div class="col-md-3">
	<?php
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( 'slider-publicacoes-image' );
	} else {
		echo '<img src="http://placehold.it/151x228" />';
	}
	?>
</div>