<?php
global $_query;
get_header();
?>

	<section id="primary" class="content-area boletim">
		<main id="main" class="site-main projetos-main" role="main">

			<div class="header-area single-projetos col-md-12 boletim">
				<h1><?php echo $_query->tax_name; ?></h1>
			</div>
			<!-- header-area col-md-12 projetos-main -->

			<?php if ( $_query->query->have_posts() ) : ?>

				<section class="col-md-12 atividades boletim">
					<?php while ($_query->query->have_posts()) : $_query->query->the_post(); ?>

						<div class="item_out col-md-4">

							<div class="post_container">
								<div class="thumb">
									<a href="<?php the_permalink(); ?>">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'medium' );
										} else {
											echo '<img src="' . theme() . '/img/thumb-equipe.png">';
										} ?>
									</a>
								</div>
								<!-- thumb -->
								<div class="col-md-12 description">
									<h3><?php the_title(); ?></h3>
									<?php echo resumo( '150' ); ?>
								</div>
								<!-- .description -->
								<div class="footer-item">
									<a class="leia" href="<?php the_permalink(); ?>">Leia mais</a>
								</div>
								<!-- .footer-item -->
							</div>
							<!-- post_container -->

						</div>
					<?php endwhile; ?>

					<div class="container pagination">
						<div class="col-md-4 col-md-offset-4">
							<?php
							$page = $_query->_page;

							$total = $_query->total_pages;
							$big   = 999999999; // need an unlikely integer
							if ( $total > 1 ) {
								if ( ! $current_page = $page ) {
									$current_page = 1;
								}
								$format = 'page/%#%/';
								echo paginate_links( array(
									'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format'    => $format,
									'current'   => max( 1, $page ),
									'total'     => $total,
									'mid_size'  => 3,
									'type'      => 'list',
									'prev_text' => '<',
									'next_text' => '>',
								) );
							}
							?>
						</div>
					</div>

				</section>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main>
		<!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>