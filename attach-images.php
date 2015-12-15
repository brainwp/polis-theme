<?php
function migration() {
	include( 'wp-admin/includes/media.php' );
	include( 'wp-admin/includes/file.php' );
	include( 'wp-admin/includes/image.php' );
	$query = new WP_Query( array(
		'post_type'      => 'noticias',
		'posts_per_page' => -1,
		'meta_query'     => array(
			array(
				'key' => 'mgr_imagem',
			),
		),
	) );

	if ( $query ) {
		$c = '';
		while ( $query->have_posts() ) :
			$query->the_post();
			$title = get_the_title();
			$i   = get_campoPersonalizado( 'mgr_imagem' );
			$img   = trim( $i );
			$_id   = get_the_ID();
			//echo $title . " " . $img . "<br>";

			if ( ! empty( $img ) ) {
				$path = explode( '.', $img );
				$url  = "http://www.polis.org.br/uploads/" . $path[0] . "/" . $img;

				$filename = download_url( $url );
				$filetype = wp_check_filetype( basename( $filename ), null );
				$wp_upload_dir = wp_upload_dir();
			    $tmp = download_url( $url );
			    $file_array = array(
			        'name' => basename( $url ),
			        'tmp_name' => $tmp
			    );

			    // Check for download errors
			    if ( is_wp_error( $tmp ) ) {
			        @unlink( $file_array[ 'tmp_name' ] );
			        return $tmp;
			    }

			    $id = media_handle_sideload( $file_array, $_id );
			    
			    // Check for handle sideload errors.
			    if ( is_wp_error( $id ) ) {
			        @unlink( $file_array['tmp_name'] );
			        return $id;
			    }

			    $attachment_url = wp_get_attachment_url( $id );
			    set_post_thumbnail( $_id, $id );

				$c++;
				echo $c . "<br>";
			}
		endwhile;
	}
}
?>