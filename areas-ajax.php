<?php
function areaAjax() {
if (isset( $_GET['areaAjax'] ) && isset( $_GET['areaCatAjax'] )) {
$area = $_GET['areaAjax'];
$cat = $_GET['areaCatAjax']; ?>
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
				'field'            => 'slug',
				'terms'            => array( $area, $cat ),
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

<div class="cada-loop-aba">
	<header>
		<h2>Publicações</h2>
		<a class="todos" href="">Ver todos</a>
	</header>
	<?php // Loop Publicações
	$args = array(
		'post_type' => 'publicacoes',
		'tax_query' => array(
			array(
				'taxonomy'         => 'categorias',
				'field'            => 'slug',
				'terms'            => array( $area, $cat ),
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
			</div><!-- .cada-publicacao-area -->
		<?php endwhile;
	} ?>
	<?php
	die();
	}
	}

	add_action( 'init', 'areaAjax', 1 );

	?>
