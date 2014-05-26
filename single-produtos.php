<?php
/**
 * The Template for displaying all single posts.
 *
 * @package carpigiani-theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<section class="slider-content-single">

			<div class="master-wrap">
				<div class="desc">
					<?php
						$terms = get_the_terms( $post->ID , 'tipos' );
						$this_term = $terms[2]->term_id;
						$this_term_name = $terms[2]->name;
						if ( $terms != null ){
							foreach( $terms as $term ) {
								echo "<h2 class=" . $term->name . ">" . $term->name . "</h2>";
								echo "<h1>" . get_the_title() . "</h1>";
								echo $term->description;
								unset( $term );
						} } ?>
				</div>

				<div id="carousel" class="wrap list_carousel responsive">

					<ul id="foo4">

					<?php
					    $slider_single = array(
					    	'post_type' => 'attachment',
					    	'numberposts' => -1,
					    	'post_status' => null,
					    	'post_parent' => $post->ID
					    	);
					    $attachments = get_posts( $slider_single );
					    if ( $attachments ) {
					        foreach ( $attachments as $attachment ) {
					            $image_attributes = wp_get_attachment_image_src( $attachment->ID, 'slider-home' ); ?>
							    <li class="item">        
							        <div class="image"><img src="<?php echo $image_attributes[0]; ?>" /></div><!-- .image -->
							    </li><!-- .item -->    
						<?php } ?>
					<?php } ?>

					</ul><!-- #foo4 -->
					
					<div class="clearfix"></div>

				</div><!-- #carousel -->

			</div><!-- .master-wrap -->

				<a id="prev-slider" class="prev" href="#"></a>
				<a id="next-slider" class="next" href="#"></a>

			</section><!-- #carousel .slider-content-single -->

			<?php get_template_part( 'content', 'single-produto' ); ?>

		<?php endwhile; // end of the loop. ?>

		<section class="footer-content-single">
			<div class="wrap">
				<div class="outras-categorias">
					<h3>Outras Categorias</h3>
					<?php
					$args = array(
								'orderby' => 'count',
								'hide_empty' => 0,
								'exclude' => $this_term,
							); 
				        $terms = get_terms( 'tipos', $args );
				        $count = count( $terms );
				        if ( $count > 0 ){
				            echo '<ul>';
				            foreach ( $terms as $term ) {
				                $termlinks = get_term_link ( $term, 'tipos' );
				                ?>
									<li class="<?php echo $term->slug; ?>">
										<a href="<?php echo $termlinks; ?>">
											<?php echo $term->name; ?>
										</a>
									</li>
						<?php  }
				       		echo "</ul>";
				        }
					?>
				</div><!-- .outras-categorias -->

				<div class="outros-produtos">					
					<h3>+ nessa categoria</h3>
					
					<div class="slider-footer-single">

						<div id="carousel" class="wrap list_carousel responsive">

							<ul id="foo3">
								<?php
								$outros_query = new WP_Query( array(
									'post_type' => 'produtos',
									'post__not_in' => array( $post->ID ),
							        'posts_per_page' => '8',
							        'tipos' => $this_term_name,
							        'caller_get_posts'=> 1
							    ) );
		    						while ($outros_query->have_posts()) : $outros_query->the_post(); ?>

									    <li class="item">        
									        <div class="image">
									        	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
									        </div><!-- .image -->
									    </li><!-- .item -->    

		    					<?php endwhile;  wp_reset_query(); ?>
							</ul><!-- #foo3 -->
							
							<div class="clearfix"></div>

						</div><!-- #carousel -->

						<a id="prev-outros" class="prev" href="#"></a>
						<a id="next-outros" class="next" href="#"></a>

					</div><!-- .slider-footer-single -->

				</div><!-- .outros-produtos -->
			</div><!-- .wrap -->
		</section><!-- .footer-content-single -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>