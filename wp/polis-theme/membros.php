<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 28/05/14
 * Time: 17:06
 */
global $_query, $user;
$page = $_query->_page;
get_header();?>

	<section class="col-md-12 content perfil <?php echo $_query->area_slug; ?>">
		<div class="col-md-12 content">
			<div class="col-md-3">
				<?php echo $_query->avatar; ?>
			</div>
			<div class="col-md-9">
				<h1 class="nome">
					<?php echo $user->first_name . ' ' . $user->last_name; ?>
				</h1>
		<span class="sep">
			|
		</span>
				<span class="cargo"><?php echo $_query->area ?></span>

				<p class="texto">
					<?php echo $user->description; ?>
				</p>
			</div>
		</div>
		<div class="col-md-5 intro <?php echo $_query->area_slug ?>">
			<span>Atividades no site da Pólis</span>
		</div>
	</section>
	<section class="col-md-12 atividades <?php echo $_query->area_slug; ?>">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="col-md-3 post_container">
				<a href="#" class="col-md-12 post">
					<?php
					if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail( 'medium' );
					} else {
						echo '<img src="' . get_bloginfo( 'template_url' ) . '/img/thumb-equipe.png">';
					}
					?>

					<h3 class="col-md-10"><?php the_title(); ?></h3>

					<div class="col-md-12">
						<?php the_excerpt(); ?>
					</div>
				</a>
			</div>
		<?php endwhile;
		else: ?>
		<?php endif; ?>
		<div class="container pagination">
			<div class="col-md-4 col-md-offset-4">
				<?php
				if ( $page != 1 ) {
					?>
					<a href="<?php echo get_bloginfo( 'url' ) ?>/equipe/<?php echo $user->user_login ?>/page/<?php echo $page - 1 ?>">&lt;</a>
				<?php
				}
				?>
				<?php
				for ( $i = 1; $i < $_query->total_pages + 1; $i ++ ) {
					if ( $i == $page ) {
						echo '<a class="atual">' . $i . '</a>';
					} else {
						echo '<a href="' . get_bloginfo( 'url' ) . '/equipe/' . $user->user_login . '/page/' . $i . '">' . $i . '</a>';
					}
				}
				?>
				<?php
				if ( $page < $_query->total_pages ) {
					?>
					<a href="<?php echo get_bloginfo( 'url' ) ?>/equipe/<?php echo $user->user_login ?>/page/<?php echo $page + 1 ?>">&gt;</a>
				<?php
				}
				?>
			</div>
		</div>
	</section>

<?php
get_footer();
?>