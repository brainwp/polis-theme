<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 22/05/14
 * Time: 11:10
 */
get_header(); ?>
	<div class="col-md-12 content text-center">
		<p class="description">
			<?php echo of_get_option( 'frase-intro-home' ); ?>
		</p>

		<p class="description areas">
			Areas de atuação do Pólis
		</p>
	</div>
	<section class="col-md-12 content atuacao">
		<div class="col-md-4 left">
			<div class="col-md-10 reforma">
				<p class="title">
					Reforma Urbana
				</p>

				<div class="col-md-12 description">
					<?php echo of_get_option( 'frase-reformaurbana-home' ); ?>
				</div>
				<a class="col-md-5 saiba left text-center" href="#">Saiba mais</a>
			</div>
			<div class="col-md-10 inclusao">
				<p class="title">
					Inclusão e Sustentabilidade
				</p>

				<div class="col-md-12 description">
					<?php echo of_get_option( 'frase-inclusao-home' ); ?>
				</div>
				<a class="col-md-5 saiba left text-center" href="#">Saiba mais</a>
			</div>
		</div>
		<div class="col-md-4 pull-right right">
			<div class="col-md-10 democracia pull-right right">
				<p class="title">Democracia e Participação</p>

				<div class="col-md-12 description">
					<?php echo of_get_option( 'frase-democracia-home' ); ?>
				</div>
				<a class="col-md-5 saiba left text-center" href="#">Saiba mais</a>
			</div>
			<div class="col-md-10 cidadania pull-right right">
				<p class="title">
					Cidadania Cultural
				</p>

				<div class="col-md-12 description">
					<?php echo of_get_option( 'frase-cidadania-home' ); ?>
				</div>
				<a class="col-md-5 saiba left text-center" href="#">Saiba mais</a>
			</div>
		</div>
		<div class="col-md-10 col-md-offset-1 consultoria-alert">
			<img src="img/consultoria-alert.png"> <!-- trocar pelo png transparente depois -->
			Interessado nos serviços de consultoria da Pólis?
			<a class="col-md-2 pull-right right" href="<?php echo of_get_option( 'link-contato-consultoria' ); ?>">Entre em contato</a>
		</div>
		<!-- colocar linha aqui <div class="col-md-12 dashed-line"></div> -->
	</section>
	<section class="col-md-12 content news">
		<div class="col-md-12">
			<div class="section-title">
				Noticias e ações em todas as areas
				<a href="#" class="col-md-1 pull-right shape-todos">Ver todos</a>
				<span class="triangle"></span>
			</div>
		</div>
		<section id="slider-news" class="carousel slide col-md-8" data-ride="carousel">
			<div class="carousel-inner">
				<?php $slider_query = new WP_Query( array(
					'post_type'      => array( 'acoes', 'noticias' ),
					'orderby'        => 'date',
					'order'          => 'ASC',
					'posts_per_page' => 6
				) );?>
				<?php $_i = 0; ?>
				<?php while ($slider_query->have_posts()) :
				$slider_query->the_post(); ?>
				<?php if ($_i == 0){ ?>
				<div class="item active">
					<?php
					}
					else{
					?>
					<div class="item">
						<?php
						}
						?>
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'slider-news-image' );
						} else {
							echo '<img src="http://placehold.it/615x171" />';
						}
						foreach ( ( get_the_category() ) as $category ) {
							echo '<a href="' . get_category_link( $category->cat_ID ) . '" class="slider-cat">' . $category->cat_name . '</a>';
						}
						?>
						<div class="left type"><?php echo get_post_type(); ?></div>
						<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>

						<div class="texto">
							<?php the_excerpt(); ?>
						</div>
						<a href="<?php the_permalink(); ?>" class="more">Leia Mais</a>
					</div>
					<?php
					$_i ++;
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<div id="slider-news-controle" class="carousel-indicators">
					<a href="#slider-news" data-slide="prev">PROXIMO</a>
					<a href="#slider-news" data-slide-to="0" class="active">ZERO</a>
					<a href="#slider-news" data-slide-to="1">UM</a>
				</div>
		</section>
		<section class="col-md-4 pull-right">
			<form class="col-md-12 newsletter">
				<p>Receba nosso boletim</p>
				Se cadastre para receber todo o nosso conteudo em primeira mão
				<input type="text" placeholder="NOME" class="col-md-12">
				<select class="col-md-12">
					<option>Area de interesse</option>
					<option>Teste2</option>
				</select>
				<input type="tel" placeholder="TEL: ( )" class="col-md-12">
				<input type="email" placeholder="Informe seu email" class="col-md-9">
				<button class="pull-right">Enviar</button>
			</form>
			<div class="col-md-12 canal">
				<div class="col-md-6">
					<p>Canal Pólis</p>
					Conheça nosso novo canal!
					<a href="#" class="col-md-8">Ao vivo</a>
				</div>
			</div>
		</section>
	</section>
	<section class="col-md-10 col-md-offset-1 publicacoes">
		<div class="links publicacoes-link">
			<a class="title" href="#">Publicações</a>
			<a class="publicacoes-link" class="ativo" data-link="<?php bloginfo( 'url' ); ?>/?ajax=todos">Ver todos</a>
			<?php
			$args = array(
				'type'         => '',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'ID',
				'order'        => 'ASC',
				'hide_empty'   => 0,
				'hierarchical' => 1,
				'exclude'      => '1',
				'include'      => '',
				'number'       => '4',
				'taxonomy'     => 'categorias',
				'pad_counts'   => false );

			$categories = get_categories( $args );
			foreach ( $categories as $category ) :
				$cat_ID = $category->term_id; // Get ID the category.
				// Get the URL of this category
				$category_link = get_category_link( $cat_ID );
				// Get the Slug of this category
				$category_slug = get_category_link( $category->slug );
				echo '<a class="publicacoes-link" data-link="' . get_bloginfo( 'url' ) . '/?slider=' . $category->slug . '">' . $category->name . '</a>';
			endforeach;
			?>
		</div>
		<div class="carousel slide col-md-12" id="slider-publicacoes" data-ride="carousel">
			<div class="carousel-inner" id="slider-ajax">
				<?php $arg = array(
					'post_type'      => array( 'publicacoes' ),
					'orderby'        => 'date',
					'ordr'          => 'ASC',
					'posts_per_page' => 4
				);?>
				<?php
				$publicacoes = new WP_Query( $arg ); ?>
				<div class="item active">
					<?php while ( $publicacoes->have_posts() ) :
						$publicacoes->the_post(); ?>
						<a class="col-md-3" href="<?php the_permalink(); ?>">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'slider-publicacoes-image' );
							} else {
								echo '<img src="http://placehold.it/151x228" />';
							}
							?>
						</a>
					<?php endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
				<?php $arg = array(
					'post_type'      => array( 'publicacoes' ),
					'orderby'        => 'date',
					'order'          => 'ASC',
					'posts_per_page' => 4,
					'offset'         => 4
				);?>
				<?php
				$publicacoes = new WP_Query( $arg ); ?>
				<div class="item">
					<?php while ( $publicacoes->have_posts() ) :
						$publicacoes->the_post(); ?>
						<a class="col-md-3" href="<?php the_permalink(); ?>">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'slider-publicacoes-image' );
							} else {
								echo '<img src="http://placehold.it/151x228" />';
							}
							?>
						</a>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
				<?php $arg = array(
					'post_type'      => array( 'publicacoes' ),
					'orderby'        => 'date',
					'order'          => 'ASC',
					'posts_per_page' => 4,
					'offset'         => 8
				);?>
				<?php
				$publicacoes = new WP_Query( $arg ); ?>
				<div class="item">
					<?php while ( $publicacoes->have_posts() ) :
						$publicacoes->the_post(); ?>
						<a class="col-md-3" href="<?php the_permalink(); ?>">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'slider-publicacoes-image' );
							} else {
								echo '<img src="http://placehold.it/151x228" />';
							}
							?>
						</a>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>