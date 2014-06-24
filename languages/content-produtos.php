<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package carpigiani-theme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-produtos' ); ?> class="box">
	<!-- <div class="entry-title-slider"><h1 class="entry-title">Produtos<?php //the_title(); ?></h1></div> -->
	<?php
	the_post_thumbnail( 'medium' );
	?>
	<a href="<?php the_permalink();?>"><?php the_title();?></a>
	<!-- <<<<<<< HEAD -->
</article>
<!-- .entry-content -->
<!-- #post-## -->
<!-- =======
		<h1 class="entry-title">Produtos<?php //the_title(); ?></h1>
		
	</article>#post-##
</div>.master-wrap
>>>>>>> master -->
