<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 28/05/14
 * Time: 17:06
 */
global $wp_query;
$_user = get_user_by( 'login', $wp_query->query_vars['nome'] );

if(username_exists($wp_query->query_vars['nome'])){
	$count_args = array(
		'post_type' => array('noticias', 'acoes', 'post', 'publicacoes'),
		'author' => $_user->ID,
		'post_per_page' => 999999
	);
	$count_query = new WP_Query( $count_args );
	$count = $count_query->found_posts;
// grab the current page number and set to 1 if no page number is set
	$page = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
	$total_posts = $count;
	$per_page = 4;

// calculate the total number of pages.
	$offset = $per_page * ( $page - 1 );
	$total_pages = ceil( $total_posts / $per_page );

	$wp_query->is_404=false;
	$_avatar = get_avatar( $_user->ID, 200 );
	$_area_slug   = get_field( 'area', 'user_' . $_user->ID );
	if($_area_slug == 'reforma'){
		$_area = 'Reforma Urbana';
	}
	elseif($_area_slug == 'inclusao'){
		$_area = 'Inclusão e Sustentabilidade';
	}
	elseif($_area_slug == 'democracia'){
		$_area = 'Democracia e Participação';
	}
	elseif($_area_slug == 'cidadania'){
		$_area = 'Cidadania Cultural';
	}
	else{
		$_area = 'Cargo';
	}
}
else{
	header("HTTP/1.1 404 Not Found");
	include('404.php');
	die();
}
get_header();?>

<section class="col-md-12 content perfil <?php echo $_area_slug ?>">
	<div class="col-md-12 content">
		<div class="col-md-3">
			<?php echo $_avatar;?>
		</div>
		<div class="col-md-9">
		<h1 class="nome">
			<?php echo $_user->first_name .' ' . $_user->last_name;?>
		</h1>
		<span class="sep">
			|
		</span>
			<span class="cargo"><?php echo $_area ?></span>
		<p class="texto">
			<?php echo $_user->description; ?>
		</p>
		</div>
	</div>
	<div class="col-md-5 intro <?php echo $_area_slug ?>">
		<span>Atividades no site da Pólis</span>
	</div>
</section>
<section class="col-md-12 atividades <?php echo $_area_slug ?>">
	<?php
	$args = array(
		'author' => $_user->ID,
		'post_type' => array('noticias', 'acoes', 'post', 'publicacoes'),
		'showposts'  => $per_page,
		'offset'  => $offset // skip the number of users that we have per page
	);
	$atividades = new WP_Query($args);
	while ( $atividades->have_posts() ) : $atividades->the_post(); ?>

		<div class="col-md-3 post_container">
			<a href="#" class="col-md-12 post">
				<?php
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					the_post_thumbnail('medium');
				}
				else{
					echo '<img src="'. get_bloginfo('template_url') .'/img/thumb-equipe.png">';
				}
				?>

				<h3 class="col-md-10"><?php the_title();?></h3>
				<div class="col-md-12">
					<?php the_excerpt(); ?>
				</div>
			</a>
		</div>
	<?php endwhile; // end of the loop. ?>
	<div class="container pagination">
		<div class="col-md-4 col-md-offset-4">
			<?php
			if($page != 1){ ?>
				<a href="<?php echo get_bloginfo( 'url' )?>/equipe/<?php echo $_user->user_login?>/?pagina=<?php echo $page-1 ?>">&lt;</a>
			<?php
			}
			?>
			<?php
			for ( $i = 1; $i < $total_pages + 1; $i ++ ) {
				if($i == $page){
					echo '<a class="atual">' . $i . '</a>';
				}
				else{
					echo '<a href="' . get_bloginfo( 'url' ) . '/equipe/'. $_user->user_login . '/?pagina=' . $i . '">' . $i . '</a>';
				}
			}
			?>
			<?php
			if($page < $total_pages){ ?>
				<a href="<?php echo get_bloginfo( 'url' )?>/equipe/<?php echo $_user->user_login?>/?pagina=<?php echo $page+1 ?>">&gt;</a>
			<?php
			}
			?>
		</div>
	</div>
</section>

<?php
get_footer();
?>