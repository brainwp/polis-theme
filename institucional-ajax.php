<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 26/05/14
 * Time: 17:35
 */
function ajaxPage() {
	if ( isset( $_GET['ajaxPage'] ) ) {
		$type = 'institucional/' . $_GET['ajaxPage'];
		$arg  = array(
			'pagename' => $type,
		);
		?>
		<?php
		$pages = new WP_Query( $arg ); ?>
		<?php while ( $pages->have_posts() ) :
			$pages->the_post(); ?>
			<h1><?php the_title();?></h1>
			<?php the_content(); ?>
		<?php endwhile; ?>
		<?php
		die();
	}
}

add_action( 'init', 'ajaxPage', 2);

?>
