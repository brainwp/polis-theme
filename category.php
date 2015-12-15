<?php /*global $post; // required
$args = array('category' => -9); // exclude category 9
$custom_posts = get_posts($args);
foreach($custom_posts as $post) : setup_postdata($post);
echo '<li>' . get_the_title() . '</li>';
endforeach;*/
?>
<?php
/*$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false 

);

// Find the specific category
$topcat = get_categories($args);
$mycat = $topcat[0]->cat_ID;

// The Query
$the_query = new WP_Query('cat='.$mycat);

// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

        <a href="<?php the_permalink() ?>" rel="bookmark">
        <img src="<?php echo get_post_meta( $post->ID, 'top_slider', true) ?>" alt="<?php the_title() ?>" />
        </a>

<?php
      endwhile;

// Reset Post Data
wp_reset_postdata();*/

?>

<?php
	$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 0,
	'hierarchical'             => 1,
	'exclude'                  => '1',
	'include'                  => '',
	'number'                   => '1',
	'taxonomy'                 => 'category');

	$categories = get_categories( $args );

	foreach( $categories as $category ) :
	$cat_ID = $category->term_id; // Get ID the category.
	// Get the URL of this category
	$category_link = get_category_link( $cat_ID );
	// Get the Slug of this category
	$category_slug = get_category_link( $category->slug );
?>

<?php //echo the_ID();
//echo $cat_ID; ?>

<section id="id-<?php echo the_ID(); ?>" class="tit-<?php echo $category->slug; ?> trick-<?php echo $category->slug; ?>" rel="<?php echo $category->slug; ?>">
	<div class="wrap">
		<div class="content-posts wrap list_carousel responsive">
			<ul id="foo2">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'th-cat-post' );
							}
							else {
								echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/th-prod-default.png" />';
							}
						?>
						<h1><a href="<?php //the_permalink(); ?>"><?php the_title(); ?></a></h1>
					</div>

				<?php endwhile; ?>

					<!-- <div class="navigation">
						<div id="next-outros" class="next next-posts"><?php //next_posts_link(); ?></div>
						<div id="prev-outros"  class="prev prev-posts"><?php //previous_posts_link(); ?></div>
					</div> -->
					<a id="prev-slider" class="prev" href="#"></a>
					<a id="next-slider" class="next" href="#"></a>

				<?php else : ?>

					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<h1>Not Found</h1>
					</div>

				<?php endif; ?>

			</ul><!-- .foo2 -->
		</div><!-- .content-posts wrap list_carousel responsive -->
	</div><!-- .wrap -->
</section><!-- .content-pagee -->

<?php endforeach; ?>