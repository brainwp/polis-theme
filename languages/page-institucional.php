<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 22/05/14
 * Time: 11:10
 */
get_header(); ?>
	<section class="col-md-12 intro-institucional">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="col-md-8">
				<h1>Institucional</h1>

				<div class="description">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="bg"></div>
			</div>
		<?php endwhile; ?>
	</section>
	<nav class="col-md-12 institucional-nav">
		<?php
		$child = get_pages( array('child_of' => $post->ID ) );
		$_i = 0;
		foreach($child as $page){
			if($_i == 0){
				echo '<a href="#" data-slug="'. $page->post_name .'" class="atual">' . $page->post_title . '</a>';
			}
			else{
				echo '<a href="#" data-slug="'. $page->post_name .'">' . $page->post_title . '</a>';
			}
		}
		?>
	</nav>

<?php get_footer(); ?>