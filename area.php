<?php global $_query; ?>
<?php get_header(); ?>

<?php
$current_term = get_term_by( 'slug', get_query_var( 'area' ), 'categorias' );
$name_term = $current_term->name;
$description_term = $current_term->description;
$current_class = $current_term->slug;
$id = $current_term->term_id;
$args = array(
	'type'         => array( 'acoes', 'post', 'noticias', 'publicacoes' ),
	'child_of'     => $id,
	'orderby'      => 'name',
	'order'        => 'ASC',
	'hide_empty'   => 1,
	'hierarchical' => 1,
	'exclude'      => 'formacao',
	'taxonomy'     => 'categorias',
	'pad_counts'   => false
);
$categorias = get_categories( $args );
// echo get_query_var( 'area' );
?>

	<div id="primary" class="content-area">
	<main id="main" class="site-main area-main <?php echo $current_class; ?>" role="main" data-slug="<?php echo $current_class; ?>">
	<div id="hide-ajax" style="display: none"></div>
	<div class="header-area <?php echo $current_class; ?>">
		<div class="left col-md-2">
			<h1><?php echo $name_term; ?></h1>
			<?php echo $description_term; ?>
		</div>
		<!-- .left -->

		<div class="col-md-2 pull-right areas">
			<?php outras_areas(); ?>
		</div>
		<!-- rigtht -->

	</div>
	<!-- .header-area -->
	<div id="ajax-publicacoes" class="hidden"></div>
	<div id="ajax-noticias" class="hidden"></div>
	<div id="ajax-acoes" class="hidden"></div>
	<div class="tabContaier">
	<ul>
		<?php $_i = 0; ?>
		<?php foreach ( $categorias as $_categorias ): ?>
			<li>
				<?php
				if ( $_i == 0 ) {
					$_first = $_categorias;
					?>
					<a class="active" data-id="<?php echo $_categorias->term_id; ?>" href="#tab<?php echo $_categorias->term_id; ?>"><span><?php echo $_categorias->name; ?></span></a>
				<?php
				} else {
					?>
					<a data-id="<?php echo $_categorias->term_id; ?>" href="#tab<?php echo $_categorias->term_id; ?>"><span><?php echo $_categorias->name; ?></span></a>
				<?php } ?>
				<?php $_i ++; ?>
			</li>
		<?php endforeach; ?>
	</ul>
	<!-- //Tab buttons -->
	<section class="col-md-12 tabDetails atividades">
	<?php $cat = $_first->term_id; ?>
	<div id="first" data-first="<?php echo $cat; ?>" style="display:none"></div>
	<div id="tab<?php echo $_first->term_id; ?>" class="tabContents aba-area">

		<div class="cada-loop-aba publicacoes">
			<div class="section-title">
				<h3>Noticias</h3>
				<a href="#" class="col-md-1 shape-todos">Ver todos</a>
			</div>
			<div class="col-md-12 list_carousel responsive">
				<?php // Loop Notícias
				$args = array(
					'post_type' => 'noticias',
					'tax_query' => array(
						array(
							'taxonomy'         => 'categorias',
							'field'            => 'id',
							'terms'            => $cat,
							'include_children' => true,
							'posts_per_page'   => 8,
						)
					)
				);
				?>
				<ul id="noticias-slider-<?php echo $cat; ?>" class="noticias">
					<?php
					$noticias = new WP_Query( $args ); // exclude category
					while ( $noticias->have_posts() ) : $noticias->the_post(); ?>
						<li class="item">
							<a href="<?php the_permalink(); ?>">
								<?php $terms = terms( 'categorias' ); ?>
								<?php $terms = explode(',',$terms);?>
								<?php
								if ( has_post_thumbnail() ) {
									$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slider-publicacoes-image', true );
									echo '<img src="' . $thumb_url[0] . '"/>';
								} else {
									echo '<img src="' . theme( '/img/default-publicacoes-thumb.jpg' ) . '"/>';
								}
								?>
								<div class="caption-container">
									<small class="caption"><?php echo $terms[0];?></small>
								</div>
								<h2 class="title"><?php the_title();?></h2>
								<div class="col-md-12 resumo"><?php echo resumo();?></div>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<div class="prev-slider" id="noticias-prev-slider-<?php echo $cat;?>"></div>
			<div class="next-slider" id="noticias-next-slider-<?php echo $cat;?>"></div>
			<div class="clear"></div>
		</div>
		<!-- .cada-loop-aba -->

		<div class="cada-loop-aba publicacoes">
			<div class="section-title">
				<h3>Publicações</h3>
				<a href="#" class="col-md-1 shape-todos">Ver todos</a>
			</div>
			<div class="col-md-12 list_carousel responsive">
				<?php // Loop Publicacoes
				$args = array(
					'post_type' => 'publicacoes',
					'tax_query' => array(
						array(
							'taxonomy'         => 'categorias',
							'field'            => 'id',
							'terms'            => $cat,
							'include_children' => true,
							'posts_per_page'   => 10,
						)
					)
				);
				?>
				<ul id="publicacoes-slider-<?php echo $cat;?>" class="publicacoes-slider">
					<?php
					$publicacoes = new WP_Query( $args ); ?>
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
									echo '<img src="' . theme( '/img/default-publicacoes-thumb.jpg' ) . '" />';
								}
								?>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<div class="prev-slider" id="publicacoes-prev-slider-<?php echo $cat;?>"></div>
			<div class="next-slider" id="publicacoes-next-slider-<?php echo $cat;?>"></div>
			<div class="clear"></div>
			<div class="todos-full">
				<a class="btn-todos-full" href="<?php echo home_url(); ?>/biblioteca">Veja todas as publicações ou faça uma busca</a>
			</div>
			<?php // teste// ?>
		</div>
		<div class="cada-loop-aba publicacoes">
			<div class="section-title">
				<h3>Ações</h3>
				<a href="#" class="col-md-1 shape-todos">Ver todos</a>
			</div>

			<div class="col-md-12 list_carousel responsive">
				<?php // Loop Ações
				$args = array(
					'post_type' => 'acoes',
					'tax_query' => array(
						array(
							'taxonomy'         => 'categorias',
							'field'            => 'id',
							'terms'            => $cat,
							'include_children' => true,
							'posts_per_page'   => 10,
						)
					)
				);
				?>
				<ul id="acoes-slider-<?php echo $cat; ?>">
					<?php
					$noticias = new WP_Query( $args ); // exclude category
					while ( $noticias->have_posts() ) : $noticias->the_post(); ?>
						<li class="item">
							<a href="<?php the_permalink(); ?>" class="col-md-3 post">
								<div class="post_container">
									<div class="thumb">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'medium' );
										} else {
											echo '<img src="' . theme() . '/img/thumb-equipe.png">';
										} ?>
										<h3><?php the_title(); ?></h3>
									</div><!-- thumb -->

									<div class="col-md-12 description">
										<?php echo resumo( 150 ); ?>
										<span class="leia" href="<?php the_permalink(); ?>">Leia mais</span>
									</div>
								</div><!-- post_container -->
							</a>
						</li>

					<?php endwhile; ?>
				</ul>
			</div>
			<div class="prev-slider" id="acoes-prev-slider-<?php echo $cat;?>"></div>
			<div class="next-slider" id="acoes-next-slider-<?php echo $cat;?>"></div>
			<div class="clear"></div>
		</div>
		<!-- .cada-loop-aba -->
	</div>
	<?php $_i = 0; ?>
	<?php foreach ( $categorias as $_categorias ): ?>
		<?php if ( $_i != 0 ) {
			$cat = $_categorias->term_id;
		?>
			<div id="tab<?php echo $cat; ?>" class="tabContents aba-area">

				<div class="cada-loop-aba publicacoes">
					<div class="section-title">
						<h3>Noticias</h3>
						<a href="#" class="col-md-1 shape-todos">Ver todos</a>
					</div>
					<div class="col-md-12 list_carousel responsive">
						<ul id="noticias-slider-<?php echo $cat; ?>" class="noticias">
						</ul>
					</div>
					<div class="prev-slider" id="noticias-prev-slider-<?php echo $cat;?>"></div>
					<div class="next-slider" id="noticias-next-slider-<?php echo $cat;?>"></div>
					<div class="clear"></div>
				</div>
				<!-- .cada-loop-aba -->

				<div class="cada-loop-aba publicacoes">
					<div class="section-title">
						<h3>Publicações</h3>
						<a href="#" class="col-md-1 shape-todos">Ver todos</a>
					</div>
					<div class="col-md-12 list_carousel responsive">
						<ul id="publicacoes-slider-<?php echo $cat;?>" class="publicacoes-slider">
						</ul>
					</div>
					<div class="prev-slider" id="publicacoes-prev-slider-<?php echo $cat;?>"></div>
					<div class="next-slider" id="publicacoes-next-slider-<?php echo $cat;?>"></div>
					<div class="clear"></div>
					<div class="todos-full">
						<a class="btn-todos-full" href="<?php echo home_url(); ?>/biblioteca">Veja todas as publicações ou faça uma busca</a>
					</div>
					<?php // teste// ?>
				</div>
				<div class="cada-loop-aba publicacoes">
					<div class="section-title">
						<h3>Ações</h3>
						<a href="#" class="col-md-1 shape-todos">Ver todos</a>
					</div>

					<div class="col-md-12 list_carousel responsive">
						<ul id="acoes-slider-<?php echo $cat; ?>">
						</ul>
					</div>

					<div class="prev-slider" id="acoes-prev-slider-<?php echo $cat;?>"></div>
					<div class="next-slider" id="acoes-next-slider-<?php echo $cat;?>"></div>
					<div class="clear"></div>
				</div>
				<!-- .cada-loop-aba -->
			</div>
		<?php } ?>
		<?php $_i ++; ?>
	<?php endforeach; ?>
	</section>
	<!-- //tab Details -->
	</div>
	<!-- //Tab Container -->
	</main>
	<!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>