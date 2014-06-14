<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Polis Theme
 */

get_header(); ?>

	<section class="col-md-12 content-canal">
		<h1>Canal Pólis</h1>

		<div class="tubepress">
			<?php echo apply_filters('the_content', '[tubepress]'); ?>
		</div><!-- tubepress -->

    </section>

<?php get_footer(); ?>