<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 05/06/14
 * Time: 16:40
 */
function register_pesquisador(){
    add_role(
	'pesquisador',
	 __( 'Pesquisador' ),
	array(
	'read'         => true,  // true allows this capability
        )
		);
}
add_action( 'init', 'register_pesquisador', 1 );

function is_logged(){
	if ( !is_user_logged_in() || !check_user_role('administrator') && !check_user_role('editor') && !check_user_role('pesquisador') ) {
		$is_private = get_post_custom_values('publicacoes_qual_tipo');
		if($is_private[0] == 'arquivistica' && is_singular() ){
			header('HTTP/1.0 403 Forbidden');
			include(get_template_directory() . '/403.php');
			die();
		}
	}
}
add_action( 'template_redirect', 'is_logged' );
