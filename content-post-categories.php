<?php

    /*
    * Template Name: Post Categories
    */

get_header(); ?>

<?php //$post = get_post($_POST['id']); ?>

<?php
global $wp_query;

//grab all categories from query string (if using `category_name`)
$category_slugs_array = explode("+",esc_attr($wp_query->query['category_name']));

$categories = array('artesanal', 'chocolate-e-creme', 'restaurante', 'solf');
$category_ids = array(5,6,7,8);

//loop through all the slugs
foreach($category_slugs_array as $category_slug) {
    //get category object using slug
    $category = get_category_by_slug( $category_slug );

    //check to make sure a matching category has been found
    if(isset($category->cat_ID)) {
        $categories[] = $category;
        $category_ids[] = $category->cat_ID;
    }
}

if ($$category_ids != 5) {
    // trago os posts relacionados a esta categoria
    var_dump('positivo');
} else {
    var_dump('negativo');
}


var_dump($categories); //array of categories
var_dump($category_ids); //array of category IDs

?>

<?php 
/*$args = array( 'post_type' => 'post', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
the_title();
echo '<div class="entry-content">';
the_title();
echo '</div>';
endwhile;*/
?>

<section class="body-category-produtos">
    <div class="wrap">
        <div class="content-posts wrap list_carousel responsive">
            <ul id="foo2">

                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

                
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <?php
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail( 'th-cat-post' );
                        }
                        else {
                            echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/th-prod-default.png" />';
                        }
                    ?>
                    <h1><a href="#"><?php the_title(); ?></a></h1>
                </div>

                <?php endwhile; ?>
                <?php else : ?>
                        <p>I'm not sure what you're looking for.</p>
                <?php endif; ?>
                

            </ul><!-- .content-posts wrap list_carousel responsive -->
        </div><!-- .wrap -->
    </div><!-- .body-category-produtos -->
</section><!-- .body-category-produtos -->

<?php get_footer(); ?>