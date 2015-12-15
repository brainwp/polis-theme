<?php
	global $_query;
	get_header();
?>

<section id="primary" class="content-area boletim">
	<main id="main" class="site-main projetos-main" role="main">

	<div class="header-area single-projetos col-md-12 boletim">
		<h1>Boletim Dicas</h1>
	</div><!-- header-area col-md-12 projetos-main -->

	<?php if ( have_posts() ) : ?>

			<section class="col-md-12 atividades boletim">
			    
			    <?php while ( $_query->boletim->have_posts() ) : $_query->boletim->the_post(); ?>
			        
					<div class="item_out col-md-4">
			        
			            <div class="post_container">
					        <div class="thumb">
					            <a href="<?php the_permalink(); ?>">
					                <?php
					                if (has_post_thumbnail()) {
					                    the_post_thumbnail('medium');
					                } else {
					                    echo '<img src="' . theme() . '/img/thumb-equipe.png">';
					                } ?>
					            </a>
					        </div><!-- thumb -->
					        <div class="col-md-12 description">
					            <h3><?php the_title(); ?></h3>
					            <?php echo resumo( '150' ); ?>
					        </div><!-- .description -->
					        <div class="footer-item">
					            <a class="leia" href="<?php the_permalink(); ?>">Leia mais</a>
					        </div><!-- .footer-item -->
					    </div><!-- post_container -->
			        
					</div>
			    <?php endwhile; ?>

			</section>

		<?php polis_theme_paging_nav(); ?>

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php get_footer(); ?>