<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Polis Theme
 */
?>
</div><!-- content-bg -->
<footer id="footer" class="col-md-12">
	<div class="col-xs-12 col-sm-6 col-md-2 menu institucional">
		<a class="title">Institucional</a>
		<?php wp_nav_menu( array('theme_location' => 'footer-institucional' )); ?>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-2 menu institucional">
		<a class="title">Áreas de atuação</a>
		<?php wp_nav_menu( array('theme_location' => 'footer-atuacao' )); ?>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-2 menu institucional">
		<a class="title">Projetos</a>
		<?php wp_nav_menu( array('theme_location' => 'footer-projetos' )); ?>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-2 menu institucional">
		<a class="title">Biblioteca</a>
		<?php wp_nav_menu( array('theme_location' => 'footer-biblioteca' )); ?>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-2 apoio">
		<span class="title">Apoio</span>
		<a href="<?php echo of_get_option( 'footer-apoio-link' );?>">
			<img src="<?php echo of_get_option( 'footer-apoio-img' );?>">
		</a>
	</div><!-- apoio -->

	<div class="col-xs-12 col-sm-6 col-md-2 apoio">
		<span class="title">Realização</span>
		<a href="<?php echo of_get_option( 'footer-realizacao-link' );?>">
			<img src="<?php echo of_get_option( 'footer-realizacao-img' );?>">
		</a>
	</div><!-- apoio -->

	<div class="col-md-12 footer">
		<div class="col-xs-12 col-sm-6 col-md-5 endereco">
			<h3><?php bloginfo( 'name' ); ?></h3>
			<p><?php echo of_get_option( 'footer-endereco' ); ?> • Tel. <?php echo of_get_option( 'telefone' ); ?></p>
		</div><!-- endereco -->

		<div class="pull-right col-xs-12 col-sm-6 col-md-5 social">
			<?php if (is_active_sidebar('widgets-redes-sociais')) : ?>
			    <?php dynamic_sidebar('widgets-redes-sociais'); ?>
			<?php endif; ?>
		</div><!-- social -->
	</div><!-- footer -->

</footer>
</div> <!-- container shadow -->
<div id="map-bg"></div>
<?php wp_footer(); ?>
</body>
</html>
