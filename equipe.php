<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 27/05/14
 * Time: 16:04
 */
global $wp_query, $_query;
$count_args = array(
	'fields' => 'all_with_meta',
	'number' => 999999
);
$user_count_query = new WP_User_Query( $count_args );
$user_count = $user_count_query->get_results();
// grab the current page number and set to 1 if no page number is set
$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$total_users = $user_count ? count( $user_count ) : 1;

// how many users to show per page
$users_per_page = 16;

// calculate the total number of pages.
$total_pages = 1;
$offset = $users_per_page * ( $page - 1 );
$total_pages = ceil( $total_users / $users_per_page );
if($page <= $total_pages){
	header("HTTP/1.1 200 OK");
	$wp_query->is_404=false;
}
else{
	header("HTTP/1.1 404 Not Found");
	$wp_query->is_404=true;
}
get_header(); ?>
	<section class="col-md-12 content equipe">
		<?php

		$args = array(
			// order results by display_name
			'orderby' => 'display_name',
			// return all fields
			'fields'  => 'all_with_meta',
			'number'  => $users_per_page,
			'offset'  => $offset // skip the number of users that we have per page
		);

		// The User Query
		$user_query = new WP_User_Query( $args );
		foreach ( $user_query->results as $user ) {
			$_user   = get_userdata( $user->ID );
			$_avatar = get_avatar( $user->ID, 200 );
			$_area   = get_field( 'area', 'user_' . $user->ID );
			?>
			<a href="<?php echo get_bloginfo('url').'/equipe/'.$_user->user_login;?>" class="col-md-3 user">
				<?php echo $_avatar; ?>
				<img src="<?php bloginfo('template_url')?>/img/image-hover.png" class="hover-icon">
				<div class="col-md-12 name reforma <?php echo $_area; ?>"><?php echo $_user->first_name .' ' . $_user->last_name;?></div>
			</a>
		<?php
		}
		if(is_404()){
			echo '<h1 style="text-align: center;"">Página não encontrada</h1>';
		}
		?>
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
		</div>
	</section>
<?php get_footer(); ?>