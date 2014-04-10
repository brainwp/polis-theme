<?php global $_query; ?>
<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<hr />

		<h1>Formação</h1>
		<hr />

			<?php // Loop Notícias
			if ($_query->noticias) {
				while($_query->noticias->have_posts()) : $_query->noticias->the_post();
				the_title();
				the_content();
				endwhile;
			}

			// Loop Publicações
			if ($_query->publicacoes) {
				while($_query->publicacoes->have_posts()) : $_query->publicacoes->the_post();
				the_title();
				the_content();
				endwhile;
			}

			// Loop Ações
			$args = '';
			$args = array(
				'post_type' => 'acoes',
				'tax_query' => array(
					array(
						'taxonomy' => 'categorias',
						'field' => 'slug',
						'terms' => 'formacao',
						'posts_per_page' => 8,
					)
				)
			);
			$acoes_query = new WP_Query( $args ); // exclude category
			while($acoes_query->have_posts()) : $acoes_query->the_post();
			the_title();
			the_content();
			endwhile;
			wp_reset_postdata();
			?>

		<?php endwhile; // end of the loop. ?>			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
