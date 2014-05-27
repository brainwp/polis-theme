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
				echo '<a class="link_institucional" id="bt-'. $page->post_name .'" data-id="'. $page->post_name .'" class="atual">' . $page->post_title . '</a>';
				$_first = $page;
			}
			else{
				echo '<a class="link_institucional" id="bt-'. $page->post_name .'" data-id="'. $page->post_name .'">' . $page->post_title . '</a>';
			}
			$_i++;
		}
		?>
	</nav>
    <section class="col-md-12 content">
		<article class="col-md-8 pull-left" id="post_ajax">
			<h1><?php echo $_first->post_title; ?></h1>
			<?php echo $_first->post_content; ?>
		</article>
		<aside class="col-md-4 pull-right">
			<?php if ( is_active_sidebar( 'widgets-institucional' ) ) : ?>
				<?php dynamic_sidebar( 'widgets-institucional' ); ?>
			<?php endif; ?>
			<div class="col-md-12 projetos">
				<div class="col-md-12">
					<div class="title">
						<?php echo $title;?>
					</div>
					<div class="description">
						<?php echo $text; ?>
					</div>
				</div>
				<div class="col-md-5 link pull-right">
					<a href="<?php echo $link; ?>">VER TODOS</a>
				</div>
			</div>
		</aside>
    </section>
<?php get_footer(); ?>