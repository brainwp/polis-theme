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
		<main id="main" class="site-main <?php echo $current_class; ?>" role="main" data-slug="<?php echo $current_class; ?>">
			<div class="header-area">
				<div class="left">
					<h1><?php echo $name_term; ?></h1>
					<?php echo $description_term; ?>
				</div>
				<!-- .left -->

				<div class="right areas">
					<?php outras_areas(); ?>
				</div>
				<!-- rigtht -->

			</div>
			<!-- .header-area -->

			<div class="tabContaier">
				<ul>
					<?php $_i = 0; ?>
					<?php foreach ( $categorias as $_categorias ): ?>
						<li>
							<?php
							if ( $_i == 0 ) {
								$_first = $_categorias;
								?>
								<a class="active" data-id="<?php echo $_categorias->term_id; ?>" href="#tab<?php echo $_categorias->term_id; ?>"><?php echo $_categorias->name; ?></a>
							<?php
							} else {
								?>
								<a data-id="<?php echo $_categorias->term_id; ?>" href="#tab<?php echo $_categorias->term_id; ?>"><?php echo $_categorias->name; ?></a>
							<?php } ?>
							<?php $_i++;?>
						</li>
					<?php endforeach; ?>
				</ul>
				<!-- //Tab buttons -->
				<div class="tabDetails">
					<?php $cat = $_first->term_id;?>
					<div id="tab<?php echo $_first->term_id;?>" class="tabContents aba-area">

						<div class="cada-loop-aba">
							<header>
								<h2>Notícias</h2>
								<a class="todos" href="">Ver todos</a>
							</header>
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
							$noticias = new WP_Query( $args ); // exclude category
							while ( $noticias->have_posts() ) : $noticias->the_post(); ?>

								<div class="cada-noticia-area">
									<h1><?php the_title(); ?></h1>
									<?php the_excerpt(); ?>
								</div><!-- .cada-noticia-area -->

							<?php endwhile; ?>

						</div>
						<!-- .cada-loop-aba -->

						<div class="cada-loop-aba publicacoes">
							<header>
								<h2>Publicações</h2>
								<a class="todos" href="">Ver todos</a>
							</header>
							<ul class="slider_area">
								<?php // Loop Publicações
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
								$publicacoes = new WP_Query( $args );
								if ( $publicacoes ) {
									while ( $publicacoes->have_posts() ) : $publicacoes->the_post(); ?>
										<div class="cada-publicacao-area">
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
								<?php } ?>
							</ul>
						</div>
						<a href="" class="btn-todas-publicacoes">Veja todas as publicações ou faça uma busca</a><!-- .btn-todas-publicacoes -->
						<div class="cada-loop-aba">
							<header>
								<h2>Ações</h2>
								<a class="todos" href="">Ver todos</a>
							</header>
							<?php
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
							$acoes = new WP_Query($args);
							// Loop Ações
							if ( $acoes ) {
								while ( $acoes->have_posts() ) : $acoes->the_post(); ?>
									<div class="cada-acao-area">
										<h1><?php the_title(); ?></h1>
										<?php the_excerpt(); ?>
									</div><!-- .cada-acao-area -->
								<?php endwhile;
							}
							?>
						</div>
						<!-- .cada-loop-aba -->
					</div>
					<?php $_i = 0; ?>
					<?php foreach ( $categorias as $_categorias ): ?>
						<?php if ( $_i != 0 ) { ?>
							<div id="tab<?php echo $_categorias->term_id; ?>" class="tabContents" data-id="<?php echo $_categorias->term_id; ?>">
							</div>
						<?php } ?>
						<?php $_i ++; ?>
					<?php endforeach; ?>
				</div>
				<!-- //tab Details -->
			</div>
			<!-- //Tab Container -->
		</main>
		<!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>