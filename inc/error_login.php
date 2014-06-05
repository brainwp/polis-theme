<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 05/06/14
 * Time: 16:40
 */
function is_logged(){
	if ( !is_user_logged_in() ) {
		$is_private = get_post_custom_values('isprivate');
		if($is_private[0] == 'sim' && is_singular() ){
			header('HTTP/1.0 403 Forbidden');
			include(get_template_directory() . '/404.php');
			die();
		}
	}
}
add_action( 'template_redirect', 'is_logged' );
