<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04/07/14
 * Time: 09:41
 */
global $_query;
get_header();?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main projetos-main" role="main">
			<div class="header-area col-md-12">
				<h1>Projetos</h1>
			</div>
			<div class="posts_container">
				<div class="tabContaier">
					<ul>
						<li>
							<?php
							// pegando as tax pra montar as abas
							$args       = array(
								'type'       => 'projetos',
								'taxonomy'   => 'projetos_tax',
								'hide_empty' => 1,
							);
							$categories = get_categories( $args );
							foreach ( $categories as $category ) {
								if ( $category->slug == $_query->projetos_tax_slug ) {
									?>
									<a class="active"
									   href="<?php bloginfo( 'url' ); ?>/projetos/tipo/<?php echo $category->slug; ?>"><span><?php echo $category->name; ?></span></a>
								<?php
								} else {
									?>
									<a href="<?php bloginfo( 'url' ); ?>/projetos/tipo/<?php echo $category->slug; ?>"><span><?php echo $category->name; ?></span></a>
								<?php
								}
							}
							?>
						</li>
					</ul>
				</div>

				<section class="col-md-12 tabDetails atividades">
					<div class="tabContents aba-area">
						<?php // aqui vai o loop ?>
						<?php if ( $_query->query->have_posts() ) : while ( $_query->query->have_posts() ) : $_query->query->the_post(); ?>

							<?php get_template_part( 'content', 'projetos' ); ?>

						<?php endwhile; ?>
						<?php endif; ?>
					</div>
					<div class="container pagination">
						<div class="col-md-4 col-md-offset-4">
							<?php
							$page      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
							$aba       = ( get_query_var( 'aba' ) ) ? get_query_var( 'aba' ) : '';
							$format    = 'page/%#%/';
							$aba_array = array();

							if ( $_query->aba_if == false ) {
								$aba_array = array(
									'aba_pag' => $_query->projetos_tax_slug
								);
							}
							$total = $_query->total_pages;

							$big = 999999999; // need an unlikely integer
							if ( $total > 1 ) {
								if ( ! $current_page = $page ) {
									$current_page = 1;
								}
								echo paginate_links( array(
									'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format'    => $format,
									'current'   => max( 1, $page ),
									'total'     => $total,
									'mid_size'  => 3,
									'type'      => 'list',
									'prev_text' => '<',
									'next_text' => '>',
									'add_args'  => $aba_array,
								) );
							}
							?>
						</div>
					</div>
				</section>
			</div>
		</main>
	</div>
<?php get_footer(); ?>