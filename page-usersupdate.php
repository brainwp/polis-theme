<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 23/09/14
 * Time: 12:03
 */
$args     = array(
	// return all fields
	'fields'     => 'all_with_meta',
	'orderby'    => 'display_name',
	'order'      => 'ASC',
	//'meta_key'   => 'area_user_order',
	'number'     => 9999999999999,
	//'offset' => $_query->offset, // skip the number of users that we have per page
);
// The User Query
$user_query = new WP_User_Query( $args );
//	global $wpdb;
//	echo $wpdb->last_query;
$count_equipe = 0;
foreach ( $user_query->results as $user ) {
	$field = get_field( 'area', 'user_' . $user->ID );
	$user_id = $user->ID;

	if($field == 'Institucional'){
		update_user_meta($user_id, 'user_area_hide', 'Institucional');
	}
	elseif($field == 'Outro'){
		update_user_meta($user_id, 'user_area_hide', 'Outro');
	}
	elseif($field == 'democracia'){
		update_user_meta($user_id, 'user_area_hide', 'democracia-e-participacao');
	}
	elseif($field == 'reforma'){
		update_user_meta($user_id, 'user_area_hide', 'reforma-urbana');
	}
	elseif($field == 'cidadania'){
		update_user_meta($user_id, 'user_area_hide', 'cidadania-cultural');
	}
	elseif($field == 'inclusao'){
		update_user_meta($user_id, 'user_area_hide', 'inclusao-e-sustentabilidade');
	}
	else{
		$term = get_term_by('slug', $field, 'areas');
		if($term && $term->parent != 0){
			$parent  = get_term($term->parent,'areas');
			update_user_meta($user_id, 'user_area_hide', $parent->slug);
		}
	}
	$count_equipe++;
}
echo 'Users atualizados: '.$count_equipe;
