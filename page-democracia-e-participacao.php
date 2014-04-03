<?php
/**
 * Template Name: Democracia e Participação
 *
 * @package Polis Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<hr />

		<h1>Formação</h1>
		<hr />

			<?php // Loop Notícias
			$args = '';
			$args = array(
				'post_type' => 'noticias',
				'tax_query' => array(
					array(
						'taxonomy' => 'categorias',
						'field' => 'slug',
						'terms' => 'formacao',
						'posts_per_page' => 8,
					)
				)
			);
			$noticias_query = new WP_Query( $args ); // exclude category
			while($noticias_query->have_posts()) : $noticias_query->the_post();
			the_title();
			the_content();
			endwhile;

			wp_reset_postdata();

			// Loop Publicações
			$args = '';
			$args = array(
				'post_type' => 'publicacoes',
				'tax_query' => array(
					array(
						'taxonomy' => 'categorias',
						'field' => 'slug',
						'terms' => 'formacao',
						'posts_per_page' => 10,
					)
				)
			);
			$publicacoes_query = new WP_Query( $args ); // exclude category
			while($publicacoes_query->have_posts()) : $publicacoes_query->the_post();
			the_title();
			the_content();
			endwhile;
			wp_reset_postdata();

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
			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
