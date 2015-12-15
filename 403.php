<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Polis Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h2 class="page-title">
                        Oops, você precisa estar logado para acessar essa página - <a href="<?php echo wp_login_url(); ?>">Login</a>
                    </h2>
				</header><!-- .page-header -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>