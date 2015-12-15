<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/09/14
 * f * Time: 16:09
 */
function ajax_equipe() {
	if ( isset( $_GET['ajaxEquipe'] ) ) {
		//echo 'wtf';
		$type    = $_GET['query'];
		$types   = array(
			'democracia-e-participacao',
			'reforma-urbana',
			'inclusao-e-sustentabilidade',
			'cidadania-cultural'
		);
		$exclude = explode( ',', of_get_option( 'equipe-exclude' ) );
		if ( in_array( $type, $types ) ) {
			$type_exp = explode( '-', $type );
			$type_exp = $type_exp[0];
			$args     = array(
				// return all fields
				'fields'     => 'all_with_meta',
				'orderby'    => 'display_name',
				'order'      => 'ASC',
				//'meta_key'   => 'area_user_order',
				'number'     => 9999999999999,
				//'offset' => $_query->offset, // skip the number of users that we have per page
				'exclude'    => $exclude,
				'meta_query' => array(
					array(
						'key'     => 'user_area_hide',
						'value'   => $type,
						'compare' => '='
					),
				)
			);
			// The User Query
			$user_query = new WP_User_Query( $args );
			//	global $wpdb;
			//	echo $wpdb->last_query;
			$count_equipe = 0;
			foreach ( $user_query->results as $user ) {
				$_user           = get_userdata( $user->ID );
				$_avatar         = get_avatar( $user->ID, 200 );
				$_area           = get_field( 'area', 'user_' . $user->ID );
				$_area_slug_term = get_term_by( 'slug', $_area, 'areas' );
				?>
				<a href="<?php echo get_bloginfo( 'url' ) . '/equipe/' . $_user->user_login; ?>" class="col-md-3 user">
					<div class="wrap-avatar"><?php echo $_avatar; ?></div>
					<img src="<?php bloginfo( 'template_url' ) ?>/img/image-hover.png" class="hover-icon">

					<div class="col-md-12 name <?php echo $type_exp; ?>">
						<?php echo $_user->first_name . ' ' . $_user->last_name; ?>
						<small><?php echo get_field( 'cargo', 'user_' . $user->ID ); ?></small>
					</div>
				</a>
				<?php $count_equipe ++; ?>
				<?php if ( $count_equipe >= 4 ) : ?>
					<?php $count_equipe = 0; ?>
				<?php endif; ?>
			<?php
			}
		} elseif ( $type == 'Institucional' ) {
			$args = array(
				// return all fields
				'fields'     => 'all_with_meta',
				'orderby'    => 'display_name',
				'order'      => 'ASC',
				//'meta_key'   => 'area_user_order',
				'number'     => 9999999999999,
				//'offset' => $_query->offset, // skip the number of users that we have per page
				'exclude'    => $exclude,
				'meta_query' => array(
					array(
						'key'     => 'area',
						'value'   => 'Institucional',
						'compare' => '='
					),
				)
			);
			// The User Query
			$user_query = new WP_User_Query( $args );
			//	global $wpdb;
			//	echo $wpdb->last_query;
			$count_equipe = 0;
			foreach ( $user_query->results as $user ) {
				$_user           = get_userdata( $user->ID );
				$_avatar         = get_avatar( $user->ID, 200 );
				$_area           = get_field( 'area', 'user_' . $user->ID );
				$_area_slug_term = get_term_by( 'slug', $_area, 'areas' );
				?>
				<a href="<?php echo get_bloginfo( 'url' ) . '/equipe/' . $_user->user_login; ?>" class="col-md-3 user">
					<div class="wrap-avatar"><?php echo $_avatar; ?></div>
					<img src="<?php bloginfo( 'template_url' ) ?>/img/image-hover.png" class="hover-icon">

					<div class="col-md-12 name <?php echo $_area; ?>">
						<?php echo $_user->first_name . ' ' . $_user->last_name; ?>
						<small><?php echo get_field( 'cargo', 'user_' . $user->ID ); ?></small>
					</div>
				</a>
				<?php $count_equipe ++; ?>
				<?php if ( $count_equipe >= 4 ) : ?>
					<?php $count_equipe = 0; ?>
				<?php endif; ?>
			<?php
			}
		} elseif ( $type == 'Outros' ) {
			$args = array(
				// return all fields
				'fields'     => 'all_with_meta',
				'orderby'    => 'meta_value',
				'order'      => 'ASC',
				'meta_key'   => 'area_user_order',
				'number'     => 9999999999999,
				//'offset' => $_query->offset, // skip the number of users that we have per page
				'exclude'    => $exclude,
				'meta_query' => array(
					array(
						'key'     => 'area',
						'value'   => 'Outro',
						'compare' => '='
					),
				)
			);
			// The User Query
			$user_query = new WP_User_Query( $args );
			//	global $wpdb;
			//	echo $wpdb->last_query;
			$count_equipe = 0;
			foreach ( $user_query->results as $user ) {
				$_user           = get_userdata( $user->ID );
				$_avatar         = get_avatar( $user->ID, 200 );
				$_area           = get_field( 'area', 'user_' . $user->ID );
				$_area_slug_term = get_term_by( 'slug', $_area, 'areas' );
				?>
				<a href="<?php echo get_bloginfo( 'url' ) . '/equipe/' . $_user->user_login; ?>" class="col-md-3 user">
					<div class="wrap-avatar"><?php echo $_avatar; ?></div>
					<img src="<?php bloginfo( 'template_url' ) ?>/img/image-hover.png" class="hover-icon">

					<div class="col-md-12 name <?php echo $_area; ?>">
						<?php echo $_user->first_name . ' ' . $_user->last_name; ?>
						<small><?php echo get_field( 'cargo', 'user_' . $user->ID ); ?></small>
					</div>
				</a>
				<?php $count_equipe ++; ?>
				<?php if ( $count_equipe >= 4 ) : ?>
					<?php $count_equipe = 0; ?>
				<?php endif; ?>
			<?php
			}
		}
		die();
	}
}

add_action( 'init', 'ajax_equipe', 1 );
?>