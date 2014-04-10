<?php
/**
 * Polis Theme functions and definitions
 *
 * @package Polis Theme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'polis_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function polis_theme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Polis Theme, use a find and replace
	 * to change 'polis-theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'polis-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'polis-theme' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'quote', 'status' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'polis_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // polis_theme_setup
add_action( 'after_setup_theme', 'polis_theme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function polis_theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'polis-theme' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'polis_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function polis_theme_scripts() {
	wp_enqueue_style( 'polis-theme-style', get_stylesheet_uri() );
	wp_enqueue_style( 'twentyeleven-style', get_stylesheet_directory_uri() . '/style-twentyeleven.css' );

	wp_enqueue_script( 'polis-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'polis-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	//wp_enqueue_script( 'radio-tax', get_template_directory_uri() . '/js/radiotax.js' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'polis_theme_scripts' );

function admin_polis_scripts() {
    wp_enqueue_style('style-admin', get_template_directory_uri() . '/style-admin.css' );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js' );
}
add_action('admin_head', 'admin_polis_scripts');

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load CPT Ações file.
 */
require get_template_directory() . '/inc/cpt-acoes.php';

/**
 * Load CPT Notícias file.
 */
require get_template_directory() . '/inc/cpt-noticias.php';

/**
 * Load CPT Publicações file.
 */
require get_template_directory() . '/inc/cpt-publicacoes.php';

/**
 * Load Tax Categorias to CPT Publicações, Notícias e Ações.
 */
require get_template_directory() . '/inc/tax-categorias.php';

/**
 * Load Tax Tipos to CPT Publicações e Notícias.
 */
require get_template_directory() . '/inc/tax-tipos.php';

require_once( get_stylesheet_directory() . '/router.php' );