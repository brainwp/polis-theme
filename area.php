<?php global $_query; ?>
<?php get_header(); ?>

	<?php
		$current_term = get_term_by( 'slug', get_query_var( 'area' ), 'categorias' );
		$name_term = $current_term->name;
		$description_term = $current_term->description;
		$current_class = $current_term->slug;
		// echo get_query_var( 'area' );
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main <?php echo $current_class; ?>" role="main">
		<div class="header-area">
			<div class="left">
				<h1><?php echo $name_term; ?></h1>
				<?php echo $description_term; ?>
			</div><!-- .left -->

			<div class="right">
				<?php outras_areas(); ?>					
			</div><!-- rigtht -->

		</div><!-- .header-area -->

<div class="tabContaier">
	<ul>
    	<li><a class="active" href="#tab1">Formação</a></li>
    	<li><a href="#tab2">Div Two</a></li>
    	<li><a href="#tab3">Div Three</a></li>
    </ul><!-- //Tab buttons -->
    <div class="tabDetails">
    	<div id="tab1" class="tabContents aba-area">
        	
        	<div class="cada-loop-aba">
        		<h1>Notícias</h1>
            <?php // Loop Notícias
			if ($_query->noticias) {
				while($_query->noticias->have_posts()) : $_query->noticias->the_post(); ?>

				<div class="cada-noticia-area">
				<h1><?php the_title(); ?></h1>
				<?php the_excerpt(); ?>
				</div><!-- .cada-noticia-area -->
				

				<?php endwhile;
			} ?>

			</div><!-- .cada-loop-aba -->

			<?php

			// Loop Publicações
			if ($_query->publicacoes) {
				while($_query->publicacoes->have_posts()) : $_query->publicacoes->the_post();
				the_title();
				the_content();
				endwhile;
			}

			// Loop Ações
			if ($_query->acoes) {
				while($_query->acoes->have_posts()) : $_query->acoes->the_post();
				the_title();
				the_content();
				endwhile;
			}
			?>
        </div><!-- //tab1 -->
    	<div id="tab2" class="tabContents">
        	<h1>Div Two</h1>
            <p>Sed gravida velit ut lorem dictum vitae venenatis dolor faucibus. In vehicula malesuada mi, vel semper sem porta in. Mauris suscipit lorem eget justo congue semper.</p>
            <p>Donec et purus eget elit tristique consequat. Integer ut orci eu augue tristique viverra nec vitae odio. Nulla sem nibh, posuere quis condimentum vitae, posuere sit amet lectus. Morbi euismod tincidunt mauris ut scelerisque.</p>
        </div><!-- //tab2 -->
    	<div id="tab3" class="tabContents">
        	<h1>Div Three</h1>
            <p>Sed gravida velit ut lorem dictum vitae venenatis dolor faucibus. In vehicula malesuada mi, vel semper sem porta in. Mauris suscipit lorem eget justo congue semper.</p>
            <p>Donec et purus eget elit tristique consequat. Integer ut orci eu augue tristique viverra nec vitae odio. Nulla sem nibh, posuere quis condimentum vitae, posuere sit amet lectus. Morbi euismod tincidunt mauris ut scelerisque.</p>
        </div><!-- //tab3 -->
    </div><!-- //tab Details -->
</div><!-- //Tab Container -->

	

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>