<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order,number=-1');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// Pull all the posts into an array
	$options_posts = array();
	$options_posts_obj = get_posts('sort_column=post_parent,menu_order');
	$options_posts[''] = 'Selecione um Post:';
	foreach ($options_posts_obj as $post) {
		$options_posts[$post->ID] = $post->post_title;
	}

	// Options Cabecalho

	if( current_user_can( 'manage_options' ) ) {
		$options[] = array(
			'name' => 'Dev',
			'type' => 'heading');

		$options[] = array(
			'name' => 'ACF_LITE',
			'desc' => 'Marque para habilitar a versão UI do ACF.',
			'id' => 'acf_check',
			'std' => '',
			'type' => 'checkbox');
	}
	
	$options[] = array(
		'name' => 'Cabeçalho',
		'type' => 'heading');

	$options[] = array(
		'name' => 'Frase no cabeçalho',
		'id'   => 'frase-head',
		'std'  => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => 'Home',
		'type' => 'heading');

	$options[] = array(
		'name' => 'Frase de introdução Beta',
		'id'   => 'frase-intro-beta',
		'std'  => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => 'Frase de introdução no home',
		'id'   => 'frase-intro-home',
		'std'  => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => 'Frase Reforma Urbana na Pagina Inicial',
		'id'   => 'frase-reformaurbana-home',
		'std'  => '',
		'type' => 'textarea');
	$options[] = array(
		'name' => 'Frase Democracia e Participação na Pagina Inicial',
		'id'   => 'frase-democracia-home',
		'std'  => '',
		'type' => 'textarea');
	$options[] = array(
		'name' => 'Frase Inclusão e Sustentabilidade na Pagina Inicial',
		'id'   => 'frase-inclusao-home',
		'std'  => '',
		'type' => 'textarea');
	$options[] = array(
		'name' => 'Frase Cidadania Cultural na Pagina Inicial',
		'id'   => 'frase-cidadania-home',
		'std'  => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => 'Rodapé',
		'type' => 'heading');

	$options[] = array(
		'name' => 'Rodapé Apoio Imagem',
		'id'   => 'footer-apoio-img',
		'std'  => '',
		'type' => 'upload');
	$options[] = array(
		'name' => 'Rodapé Apoio Link',
		'id'   => 'footer-apoio-link',
		'std'  => '',
		'type' => 'text');
	$options[] = array(
		'name' => 'Rodapé Realização Imagem',
		'id'   => 'footer-realizacao-img',
		'std'  => '',
		'type' => 'upload');
	$options[] = array(
		'name' => 'Rodapé Realização Link',
		'id'   => 'footer-realizacao-link',
		'std'  => '',
		'type' => 'text');
	$options[] = array(
		'name' => 'Twitter Link',
		'id'   => 'social-twitter-link',
		'std'  => '',
		'type' => 'text');
	$options[] = array(
		'name' => 'Facebook Link',
		'id'   => 'social-facebook-link',
		'std'  => '',
		'type' => 'text');
	$options[] = array(
		'name' => 'Vimeo Link',
		'id'   => 'social-vimeo-link',
		'std'  => '',
		'type' => 'text');
	$options[] = array(
		'name' => 'Endereço',
		'id'   => 'footer-endereco',
		'std'  => '',
		'type' => 'text');
	$options[] = array(
		'name' => 'Telefone',
		'id'   => 'telefone',
		'std'  => '',
		'type' => 'text');

    $options[] = array(
        'name' => 'Biblioteca',
        'type' => 'heading');

    $options[] = array(
        'name' => 'Introdução',
        'id'   => 'biblioteca-intro',
        'std'  => '',
        'type' => 'textarea');

    $options[] = array(
        'name' => 'Introdução ao formulário',
        'id'   => 'biblioteca-form-intro',
        'std'  => '',
        'type' => 'textarea');

    $options[] = array(
        'name' => 'Resultados por página (contando todas as abas)',
        'id'   => 'biblioteca-busca-per-page',
        'std'  => '20',
        'type' => 'text');

    $options[] = array(
        'name' => 'Equipe',
        'type' => 'heading');

    $options[] = array(
        'name' => 'Membros por página (/equipe/)',
        'id'   => 'equipe-per-page',
        'std'  => '16',
        'type' => 'text');

    $options[] = array(
        'name' => 'Atividades por pagina (no perfil do usuario em /equipe/USERNAME)',
        'id'   => 'equipe-atividades-per-page',
        'std'  => '16',
        'type' => 'text');

    $options[] = array(
        'name' => 'Excluir membros da página de equipe por ID (separados por virgula)',
        'id'   => 'equipe-exclude',
        'std'  => '',
        'type' => 'text');

    $options[] = array(
        'name' => 'Projetos',
        'type' => 'heading');

    $options[] = array(
        'name' => 'Projetos por pagina (/projetos/)',
        'id'   => 'projetos-per-page',
        'std'  => '16',
        'type' => 'text');

    $options[] = array(
        'name' => 'Areas',
        'type' => 'heading');

    $options[] = array(
        'name' => 'Numero de posts por página no archive das areas',
        'id'   => 'areas-archive-per-page',
        'std'  => '16',
        'type' => 'text');

    $options[] = array(
        'name' => 'Colecões',
        'type' => 'heading');

    $options[] = array(
        'name' => 'Numero de posts por página no /colecoes/',
        'id'   => 'colecoes-per-page',
        'std'  => '15',
        'type' => 'text');

    $options[] = array(
        'name' => 'Canal',
        'type' => 'heading');

    $options[] = array(
        'name' => 'Numero de posts por página no /canal/',
        'id'   => 'colecoes-per-page',
        'std'  => get_option( 'posts_per_page' ),
        'type' => 'text');

    return $options;
}
