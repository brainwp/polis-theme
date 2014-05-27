	<?php global $produtos; while ( $produtos->have_posts() ) : $produtos->the_post(); ?>
	
		<li class="item">        
	    	<a href="<?php the_permalink(); ?>">
	    		<?php the_post_thumbnail( 'slider-archive-produto' ); ?>
	    	</a>
			<a class="permalink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>	
		</li><!-- .item -->    

	<?php endwhile; // end of the loop. ?>

	</ul><!-- #foo7 -->
	
	<div class="clearfix"></div>

</div><!-- #carousel -->
