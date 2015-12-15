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
		    if($_GET['idioma'] == 'ptbr'):
		    	$pages->the_post(); ?>
                <h1><?php echo get_post_meta( get_the_ID(), 'title_ptbr', true ); ?></h1>
                <?php
                   $content = get_post_meta( get_the_ID(), 'content_ptbr', true );
                   $content = apply_filters( 'the_content',  $content);
                   $content = str_replace( ']]>', ']]&gt;', $content );
                   echo $content;
                ?>		    
            <?php endif;
		    if($_GET['idioma'] == 'es'):
		    	$pages->the_post();
		        if( get_post_meta( get_the_ID(), 'active_es', true ) == 'true'): ?>
		           <h1><?php echo get_post_meta( get_the_ID(), 'title_es', true ); ?></h1>
		           <?php
                   $content = get_post_meta( get_the_ID(), 'content_es', true );
                   $content = apply_filters( 'the_content',  $content);
                   $content = str_replace( ']]>', ']]&gt;', $content );
                   echo $content;
                   ?>		    
               <?php endif;?>
		    <?php endif; ?>
		<?php endwhile; ?>
		<?php
		die();
	}
}

add_action( 'init', 'ajaxPage', 2);

?>
