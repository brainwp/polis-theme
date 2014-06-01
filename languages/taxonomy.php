<?php
/*$categories = get_the_category();
$separator = ' ';
$output = '';
if($categories){
	foreach($categories as $category) {
		$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
	}
echo trim($output, $separator);
}*/

$categories = get_categories( $args );

foreach( $categories as $category ) :
$cat_ID = $category->term_id; // Get ID the category.
// Get the URL of this category
$category_link = get_category_link( $cat_ID );
// Get the Slug of this category
$category_slug = get_category_link( $category->slug );
?>
<?php endforeach; ?>

<?php echo $category->slug; ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<section id="" class="body-category-produtos tit-<?php echo $category->slug; ?>">
			<div class="wrap">

					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<?php the_content(); ?>
					</div>

				<?php endwhile; ?>

					<div class="navigation">
						<div class="next-posts"><?php next_posts_link(); ?></div>
						<div class="prev-posts"><?php previous_posts_link(); ?></div>
					</div>

				<?php else : ?>

					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<h1>Not Found</h1>
					</div>

				<?php endif; ?>
			</div>
		</section><!-- .content-pagee -->
	</div>
</div>