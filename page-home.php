<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 22/05/14
 * Time: 11:10
 */
get_header(); ?>
	<section class="col-md-12 content text-center">
		<p class="description">
			<?php echo of_get_option( 'frase-intro-home' ); ?>
		</p>

		<p class="description text-areas">
			Áreas de atuação do Pólis
		</p>
	</section>
	<section class="col-md-12 content atuacao">
		<div class="col-md-4 left">
			<div class="col-md-10 reforma">
				<p class="title">Reforma Urbana</p>

				<div class="col-md-12 description">
					<?php echo of_get_option( 'frase-reformaurbana-home' ); ?>
				</div>
				<a class="col-md-5 saiba left text-center" href="<?php echo home_url(); ?>/area/reforma-urbana">Saiba mais</a>
			</div>
			<div class="col-md-10 inclusao">
				<p class="title">Inclusão e Sustentabilidade</p>

				<div class="col-md-12 description">
					<?php echo of_get_option( 'frase-inclusao-home' ); ?>
				</div>
				<a class="col-md-5 saiba left text-center" href="<?php echo home_url(); ?>/area/inclusao-e-sustentabilidade">Saiba mais</a>
			</div>
		</div>
		<div class="col-md-4 pull-right right">
			<div class="col-md-10 democracia pull-right right">
				<p class="title">Democracia e Participação</p>

				<p class="description">
					<?php echo of_get_option( 'frase-democracia-home' ); ?>
				</p>
				<a class="col-md-5 saiba left text-center" href="<?php echo home_url(); ?>/area/democracia-e-participacao">Saiba mais</a>
			</div>
			<div class="col-md-10 cidadania pull-right right">
				<p class="title">Cidadania Cultural</p>

				<p class="description">
					<?php echo of_get_option( 'frase-cidadania-home' ); ?>
				</p>
				<a class="col-md-5 saiba left text-center" href="<?php echo home_url(); ?>/area/cidadania-cultural">Saiba mais</a>
			</div>
		</div>
		<div class="col-md-10 col-md-offset-1 consultoria-alert">
			<img src="<?php bloginfo('template_url');?>/img/consultoria-alert.png"> <!-- trocar pelo png transparente depois -->
			<span>Interessado nos serviços de consultoria da Pólis?</span>
			<a class="pull-right right" href="<?php echo home_url(); ?>/contato">Entre em contato</a>
		</div>

		<div class="linha-tracejada"></div>

	</section>
	<section class="col-md-12 content news">
		<div class="col-md-12">
			<div class="section-title">
				<h3>Notícias e ações em todas as Áreas</h3>
				<a href="#" class="col-md-1 shape-todos">Ver todos</a>
			</div>
		</div>

		<article id="slider-news" class="carousel slide col-md-7" data-ride="carousel">
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
						<?php }	?>

						<div class="thumb">
							<a href="<?php the_permalink(); ?>">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'slider-news-image' );
								} else {
									echo '<img src="'. theme('/img/default615x170.jpg') .'" />';
								} ?>
							</a>
							<?php $terms = terms( 'categorias' ); ?>
							<?php $class_term = explode(", ", $terms); ?>
							<div class="news-terms bg-<?php echo sanitize_title($class_term[0]); ?>">
								<?php echo $terms; ?>
							</div>
						</div><!-- thumb -->
						<div class="left type"><?php echo get_post_type(); ?></div>
						<h3><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h3>

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
		</article>
		<section class="col-md-5 pull-right">
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
					<a href="#" class="col-md-8 btn-ao-vivo">Ao vivo</a>
				</div>
				<a href="#" class="full-link"></a>
			</div>
		</section>
	</section>

	<section class="col-md-12 content publicacoes">

	<div class="linha-tracejada"></div>

		<div class="section-title">
			<h3>Publicações</h3>
			<a href="#" class="col-md-1 shape-todos">Ver todos</a>
		</div>
		<div id="hide-ajax" style="display: none"></div>
		<div id="carousel" class="col-md-12 list_carousel responsive">
			<?php $arg = array(
				'post_type'      => array( 'publicacoes' ),
				'orderby'        => 'date',
				'ordr'           => 'ASC',
				'posts_per_page' => 15
			);?>
			<ul id="slider2">
				<?php
				$publicacoes = new WP_Query( $arg ); ?>
				<?php while ( $publicacoes->have_posts() ) :
					$publicacoes->the_post(); ?>
					<li class="item">
						<a href="<?php the_permalink(); ?>">

							<div class="hover"></div>

							<?php
							if ( has_post_thumbnail() ) {
								$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-publicacoes-image', true );
								echo '<img src="' . $thumb_url[0] . '"/>';
							} else {
								echo '<img src="'. theme('/img/default-publicacoes-thumb.jpg') .'" />';
							}
							?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>

		<div class="clear"></div>

		<div class="todos-full"><a class="btn-todos-full" href="<?php echo home_url(); ?>/biblioteca">Veja todas as publicações ou faça uma busca</a></div>

	</section>
	<section class="col-md-12 content widgets-home">
		<?php if ( is_active_sidebar( 'widgets-home' ) ) : ?>
			<?php dynamic_sidebar( 'widgets-home' ); ?>
		<?php endif; ?>
	</section>
<?php get_footer(); ?>