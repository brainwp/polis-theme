<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 27/05/14
 * Time: 16:04
 */
global $_query;
$page = $_query->_page;
$total_pages = $_query->total_pages;
get_header(); ?>
	<section class="col-md-12 content equipe">
		<?php

		$args = array(
			// order results by display_name
			'orderby' => 'display_name',
			// return all fields
			'fields'  => 'all_with_meta',
			'number'  => $_query->users_per_page,
			'offset'  => $_query->offset // skip the number of users that we have per page
		);

		?>

		<h1>Equipe</h1>

		<?php
		$user_query = new WP_User_Query( $args );
		foreach ( $user_query->results as $user ) {
			$_user   = get_userdata( $user->ID );
			$_avatar = get_avatar( $user->ID, 250 );
			$_area   = get_field( 'area', 'user_' . $user->ID );
			if ( !empty($_user->first_name)) {
				$_name = $_user->first_name . ' ' . $_user->last_name;
			} else {
				$_name = $_user->user_login;
			}
			?>
			<a href="<?php echo get_bloginfo('url').'/equipe/'.$_user->user_login;?>" class="col-md-3 user">
				<div class="hover"></div>
				<?php echo $_avatar; ?>
				<div class="col-md-12 name reforma <?php echo $_area; ?>"><?php echo $_name; ?></div>
			</a>
		<?php
		}
		?>

		<?php if ( $total_pages >= 2 ) : ?>

		<div class="container pagination">
			<div class="col-md-4 col-md-offset-4">
				<?php
				if($page != 1){ ?>
					<a href="<?php echo get_bloginfo( 'url' )?>/equipe/page/<?php echo $page-1 ?>">&lt;</a>
				<?php
				}
				?>
				<?php
				for ( $i = 1; $i < $total_pages + 1; $i ++ ) {
					if($i == $page){
						echo '<a class="atual" href="' . get_bloginfo( 'url' ) . '/equipe/?pagina=' . $i . '">' . $i . '</a>';
					}
					else{
						echo '<a href="' . get_bloginfo( 'url' ) . '/equipe/page/' . $i . '">' . $i . '</a>';
					}
				}
				?>
				<?php
				if($page < $total_pages){ ?>
					<a href="<?php echo get_bloginfo( 'url' )?>/equipe/page/<?php echo $page+1 ?>">&gt;</a>
				<?php
				}
				?>
			</div>
		</div><!-- container pagination -->

		<?php endif ?>

	</section>
<?php get_footer(); ?>