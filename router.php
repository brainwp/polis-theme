<?php

require_once( get_stylesheet_directory() . '/models.php' );
require_once( get_stylesheet_directory() . '/urls.php' );
require_once( get_stylesheet_directory() . '/query.php' );

/* Main section */

add_action( 'query_vars', '_query_vars' );
function _query_vars ( $query_vars ) {
    $vars = array();
    foreach( _query_rules() as $rule => $query ) {
        parse_str( $query, $qs );
        foreach ( array_keys( $qs ) as $q ) {
            $vars[] = $q;
        }
    }
    return array_unique( $vars ) + $query_vars;
}

add_action( 'rewrite_rules_array', '_rewrite_rules' );
function _rewrite_rules( $rules ) {
    $prefix = 'index.php?';

    $_rules = array();
    foreach( _query_rules() as $rule => $query ) {
        $_rules[ $rule ] = $prefix . $query;
    }
    return array_merge($_rules, $rules);

}

add_action( 'pre_get_posts', '_pre_get_posts', 1 );
function _pre_get_posts ( $query ) {
	if ( !$query->is_main_query() )
		return;
	_query_processor( $query );
	add_action( 'template_redirect', '_template_redirect' );
}

function _template_redirect( $template ) {
	global $_query, $wp_query;
	//configurando o erro 404 das paginas equipe.php e membros.php
	if(get_query_var( 'template' ) == 'equipe' || get_query_var( 'template' ) == 'membros' ){
		if($_query->error == false){
			header( "HTTP/1.1 200 ok" );
			$wp_query->is_404 = false;
		}
		elseif($_query->error == true){
			header( "HTTP/1.1 404 Not Found" );
			$wp_query->is_404 = true;
			include('404.php');
			die();
		}
	}
    if(get_query_var( 'template' ) == 'biblioteca-search'){
        header( "HTTP/1.1 200 ok" );
        $wp_query->is_404 = false;
    }
	$file = locate_template( $_query->template . '.php' );
	if ( !empty( $file ) ) {
		include( $file );
		exit();
	}
}
