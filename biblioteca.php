<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 03/06/14
 * Time: 10:29
 */
get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="header-area">
				<div class="left">
					<h1>Biblioteca</h1>
					O Pólis é uma Organização-Não-Governamental (ONG) de atuação nacional, com participação em redes internacionais e locais, constituída como associação civil sem fins lucrativos, apartidária, pluralista e reconhecida como entidade de utilidade pública.
				</div>
			</div>
			<section class="col-md-12">
				<?php if ( is_user_logged_in() ) {
					// Verifica se user está logado e seta uma variavel pra comparar o CUSTOM POST FIELD assim não preciso fazer 2 querys pra cada
					$compare_value = array( 'sim', 'nao' );
				} else {
					$compare_value = array( 'nao' );
				}
				$args = array(
					'tax_query'  => array(
						array(
							'taxonomy'         => 'tipos',
							'field'            => 'slug',
							'terms'            => 'series-e-livros',
							'include_children' => true,
							'posts_per_page'   => 10,
						),
					),
					'meta_query' => array(
						array(
							'key'     => 'isprivate',
							'value'   => $compare_value,
							'compare' => 'IN',
						),
					),
				);
				$series = new WP_Query( $args ); ?>
				<header>
					<h2>Séries e livros</h2>
					<a class="todos" href="">Ver todos</a>
				</header>
				<ul class="slider_area">
					<?php while ( $series->have_posts() ) :
						$series->the_post(); ?>
						<div class="cada-publicacao-area col-md-2">
							<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'slider-publicacoes-thumb' );
								} else {
									?>
									<img src="<?php echo get_template_directory_uri(); ?>/img/default-publicacoes-thumb.jpg" alt="<?php the_title(); ?>" />
								<?php } ?>
							</a>
						</div>
					<?php endwhile; ?>
				</ul>

			</section>
			<section class="col-md-12 atividades biblioteca">
				<?php
				$args = array(
					'tax_query'  => array(
						array(
							'taxonomy'         => 'tipos',
							'field'            => 'slug',
							'terms'            => 'documentos-e-textos',
							'include_children' => true,
							'posts_per_page'   => 10,
						),
					),
					'meta_query' => array(
						array(
							'key'     => 'isprivate',
							'value'   => $compare_value,
							'compare' => 'IN',
						),
					),
				);
				$series = new WP_Query( $args ); ?>
				<header>
					<h2>Documentos e textos</h2>
					<a class="todos" href="">Ver todos</a>
				</header>
				<ul class="slider_documentos">
					<?php while ( $series->have_posts() ) :
						$series->the_post(); ?>
						<div class="col-md-3 post_container">
							<a href="<?php the_permalink();?>" class="col-md-12 post">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'medium' );
								} else {
									echo '<img src="' . get_bloginfo( 'template_url' ) . '/img/default-biblioteca-thumb.jpg">';
								}
								?>
								<h3 class="col-md-10"><?php the_title(); ?></h3>

								<div class="col-md-12">
									<?php the_excerpt(); ?>
								</div>
							</a>
						</div>
					<?php endwhile; ?>
				</ul>

			</section>
			<section class="col-md-12 atividades biblioteca">
				<?php
				$args = array(
					'tax_query'  => array(
						array(
							'taxonomy'         => 'tipos',
							'field'            => 'slug',
							'terms'            => 'documentos-e-textos',
							'include_children' => true,
							'posts_per_page'   => 10,
						),
					),
					'meta_query' => array(
						array(
							'key'     => 'isprivate',
							'value'   => $compare_value,
							'compare' => 'IN',
						),
					),
				);
				$series = new WP_Query( $args ); ?>
				<header>
					<h2>Teses e Artigos</h2>
					<a class="todos" href="">Ver todos</a>
				</header>
				<ul class="slider_documentos">
					<?php while ( $series->have_posts() ) :
						$series->the_post(); ?>
						<div class="col-md-3 post_container">
							<a href="<?php the_permalink();?>" class="col-md-12 post">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'medium' );
								} else {
									echo '<img src="' . get_bloginfo( 'template_url' ) . '/img/default-biblioteca-thumb.jpg">';
								}
								?>
								<h3 class="col-md-10"><?php the_title(); ?></h3>

								<div class="col-md-12">
									<?php the_excerpt(); ?>
								</div>
							</a>
						</div>
					<?php endwhile; ?>
				</ul>

			</section>
		</main>
	</div>
<?php get_footer(); ?>