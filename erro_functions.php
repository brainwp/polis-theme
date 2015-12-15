<?php
/**
 * Polis Theme functions and definitions
 *
 * @package Polis Theme
 */

// options framework codes
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options-framework/inc/');
require_once dirname(__FILE__) . '/inc/options-framework/inc/options-framework.php';
include(dirname(__FILE__) . "/options.php");

function acf_check()
{
    if (of_get_option('acf_check')) {
        return false;
    } else {
        return true;
    }
}

define('ACF_LITE', acf_check());
require get_template_directory() . '/inc/acf.php';
require get_template_directory() . '/inc/search_content.php';

/**
 * Desabilita o script HeartBeat no Admin, exceto em post.php e post-new.php.
 */
add_action('init', 'polis_deregister_heartbeat', 1);
function polis_deregister_heartbeat()
{
    global $pagenow;

    if ('post.php' != $pagenow && 'post-new.php' != $pagenow && 'edit.php' != $pagenow)
        wp_deregister_script('heartbeat');
}

/**
 *
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
    $content_width = 640; /* pixels */
}

if (!function_exists('polis_theme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function polis_theme_setup()
    {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Polis Theme, use a find and replace
         * to change 'polis-theme' to the name of your theme in all the template files
         */
        load_theme_textdomain('polis-theme', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'polis-theme'),
        ));

        // Enable support for Post Formats.
        add_theme_support('post-formats', array('aside', 'quote', 'status'));

        // Setup the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('polis_theme_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Enable support for HTML5 markup.
        add_theme_support('html5', array('comment-list', 'search-form', 'comment-form',));
    }
endif; // polis_theme_setup
add_action('after_setup_theme', 'polis_theme_setup');


/* Adiciona tamanhos de imagens */
function custom_images()
{
    if (function_exists('add_image_size')) {
        /*add_image_size( 'busca-thumb', 87, 130, true );*/
        add_image_size('slider-news-image', 615, 171);
        add_image_size('news-image-horizontal', 700, 200);
        add_image_size('slider-publicacoes-image', 151, 228);
        add_image_size('slider-publicacoes-thumb', 160, 240, true);
    }
}

add_action('init', 'custom_images', 1);

function emptyReturn($var)
{
    $var = trim($var);
    $var = empty($var);

    return $var;
}

function get_campoPersonalizado($campo)
{
    $informacao_campo = get_post_custom_values($campo);
    return $informacao_campo[0];
}

function resumo($custom_max = '', $sep = '')
{
    global $_query;
    $string = get_the_excerpt();
    if (empty($string)) {
        return '';
    } else {
        if (empty($sep)) {
            $sep = ' [...]';
        }
        if (empty($custom_max)) {
            $max = 100;
        } else {
            $max = $custom_max;
        }

        if (strlen($string) > $max) {
            while (substr($string, $max, 1) <> ' ' && ($max < strlen($string))) {
                $max++;
            };
        };
        return substr($string, 0, $max) . $sep;
    }
}
function resumo_publicacoes($custom_max = '', $sep = '')
{
    global $_query;
    $string = wp_strip_all_tags(get_field('publicacoes_content'));
    if (empty($string)) {
        return '';
    } else {
        if (empty($sep)) {
            $sep = ' [...]';
        }
        if (empty($custom_max)) {
            $max = 100;
        } else {
            $max = $custom_max;
        }

        if (strlen($string) > $max) {
            while (substr($string, $max, 1) <> ' ' && ($max < strlen($string))) {
                $max++;
            };
        };
        return substr($string, 0, $max) . $sep;
    }
}
function the_content_publicacoes(){
    echo apply_filters('the_content', get_field('publicacoes_content'));
}
function get_the_content_publicacoes(){
    return apply_filters('the_content', get_field('publicacoes_content'));
}
/**
 * Register widgetized area and update sidebar with default widgets.
 */
function polis_theme_widgets_init()
{
    register_sidebar(array(
        'name' => __('Widgets-Home', 'polis-theme'),
        'id' => 'widgets-home',
        'before_widget' => '<aside class="col-md-4">',
        'after_widget' => '</aside>',
    ));
    register_sidebar(array(
        'name' => __('Widgets-institucional', 'polis-theme'),
        'id' => 'widgets-institucional',
    ));
    register_sidebar(array(
        'name' => __('Widget Boletim Home', 'polis-theme'),
        'id' => 'widgets-boletim-home',
    ));
    register_sidebar(array(
        'name' => __('Widget Redes Sociais Rodapé', 'polis-theme'),
        'id' => 'widgets-redes-sociais',
    ));

}

add_action('widgets_init', 'polis_theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function polis_theme_scripts()
{
    wp_enqueue_style('polis-theme-style', get_stylesheet_uri());
    //wp_enqueue_style( 'eve-style', get_template_directory_uri() . '/style-eve.css' );
    //wp_enqueue_style( 'twentyeleven-style', get_stylesheet_directory_uri() . '/style-twentyeleven.css' );
    wp_enqueue_script('jquery');
    wp_enqueue_script('polis-theme-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20120206', true);
    wp_enqueue_script('polis-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true);
    wp_enqueue_script('polis-theme-caroufredsel', get_template_directory_uri() . '/js/caroufredsel/jquery.carouFredSel-6.2.1-packed.js', array(), '20120206', true);
    wp_enqueue_script('polis-theme-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20120206', true);


    wp_enqueue_script('polis-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);
    wp_enqueue_script('tinynav', get_template_directory_uri() . '/js/tinynav.min.js');
    wp_enqueue_script('custom_js', get_template_directory_uri() . '/js/custom.js');

    if (is_home() || is_front_page()) {
        wp_enqueue_style('polis-magnific-style', get_template_directory_uri() . '/js/magnific/magnific-popup.css');
        wp_enqueue_script('polis-magnific-scripts', get_template_directory_uri() . '/js/magnific/jquery.magnific-popup.min.js');
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'polis_theme_scripts');

function admin_polis_scripts()
{
    wp_enqueue_style('style-admin', get_template_directory_uri() . '/style-admin.css');
    wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js');
}

add_action('admin_head', 'admin_polis_scripts');

if (!is_admin()) {
    add_action('init', 'init_theme_method');
    function init_theme_method()
    {
        add_thickbox();
    }
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Load CPT Vídeos file.
 */
require get_template_directory() . '/inc/cpt-videos.php';

/**
 * Load CPT Ações file.
 */
require get_template_directory() . '/inc/cpt-acoes.php';

/**
 * Load CPT Projetos file.
 */
require get_template_directory() . '/inc/cpt-projetos.php';
require get_template_directory() . '/inc/tax-projetos.php';

/**
 * Load CPT Notícias file.
 */
require get_template_directory() . '/inc/cpt-noticias.php';
require get_template_directory() . '/inc/tax-tags.php';

/**a
 * Load CPT Publicações file.
 */
require get_template_directory() . '/inc/cpt-publicacoes.php';
require get_template_directory() . '/inc/tax-autor.php';
require get_template_directory() . '/inc/tax-categorias.php';

/**
 * Load Tax Categorias to CPT Publicações, Notícias e Ações.
 */
require get_template_directory() . '/inc/tax-areas.php';

/**
 * Load Tax Tipos to CPT Publicações e Notícias.
 */
require get_template_directory() . '/inc/tax-tipos.php';

require_once(get_stylesheet_directory() . '/router.php');

register_nav_menu('footer-institucional', 'Footer Institucional');
register_nav_menu('footer-atuacao', 'Footer Areas de Atuação');
register_nav_menu('footer-projetos', 'Footer Projetos');
register_nav_menu('footer-biblioteca', 'Footer Bibliotecas');

//ajax
require get_template_directory() . '/institucional-ajax.php';
require get_template_directory() . '/areas-ajax.php';
require get_template_directory() . '/biblioteca-count-ajax.php';
require get_template_directory() . '/biblioteca-sub-count-ajax.php';
require get_template_directory() . '/equipe-ajax.php';

//widget home

/**
 * Imprime o menu na Home de cada Área com link para as outras 3 Áreas
 */
function outras_areas_cpt()
{
    global $_query;

    $array_areas = array("cidadania-cultural", "democracia-e-participacao", "inclusao-e-sustentabilidade", "reforma-urbana");
    $current_area = get_term_by('slug', $_query->area, 'areas');

    if (($key = array_search($current_area->slug, $array_areas)) !== false) {
        unset($array_areas[$key]);
    }

    echo "<ul>";
    echo "<li class=title-outras>Outras áreas de atuação</li>";

    foreach ($array_areas as $area) {
        $each_area = get_term_by('slug', $area, 'areas');
        echo "<li class='btn-" . $area . "'>";
        echo "<a href='" . home_url() . "/area/" . $each_area->slug . "'>" . $each_area->name . "</a>";
        echo "</li>";
    }

    echo "</ul>";

}

function outras_areas()
{

    $array_areas = array("cidadania-cultural", "democracia-e-participacao", "inclusao-e-sustentabilidade", "reforma-urbana");
    $current_area = get_term_by('slug', get_query_var('area'), 'areas');

    if (($key = array_search($current_area->slug, $array_areas)) !== false) {
        unset($array_areas[$key]);
    }

    echo "<ul>";
    echo "<li class=title-outras>Outras áreas de atuação</li>";

    foreach ($array_areas as $area) {
        $each_area = get_term_by('slug', $area, 'areas');
        echo "<li class='btn-" . $area . "'>";
        echo "<a href='" . home_url() . "/area/" . $each_area->slug . "'>" . $each_area->name . "</a>";
        echo "</li>";
    }

    echo "</ul>";

}

function todas_areas()
{

    $array_areas = array("cidadania-cultural", "democracia-e-participacao", "inclusao-e-sustentabilidade", "reforma-urbana");

    echo "<ul>";
    echo "<li class=title-outras>Outras áreas de atuação</li>";

    foreach ($array_areas as $area) {
        $each_area = get_term_by('slug', $area, 'areas');
        echo "<li class='btn-" . $area . "'>";
        echo "<a href='" . home_url() . "/area/" . $each_area->slug . "'>" . $each_area->name . "</a>";
        echo "</li>";
    }

    echo "</ul>";

}

function return_term_biblioteca($slug)
{
    global $post;
    $terms = get_the_terms($post->ID, $slug);

    if ($terms && !is_wp_error($terms)) :

        foreach ($terms as $term) {
            return $term->slug;
            break;
        }
    endif;
}

function return_term_biblioteca_area()
{
    global $post;
    $slug = 'categorias';
    $terms = get_the_terms($post->ID, $slug);

    if ($terms && !is_wp_error($terms)) :
        foreach ($terms as $term) {
            if ($term->slug == 'cidadania-cultural' || $term->slug == 'democracia-e-participacao' || $term->slug == 'inclusao-e-sustentabilidade' || $term->slug == 'reforma-urbana') {
                return $term->slug;
                break;
            }
        }
    endif;
}

function return_term_biblioteca_name($slug)
{
    global $post;
    $terms = get_the_terms($post->ID, $slug);

    if ($terms && !is_wp_error($terms)) :


        foreach ($terms as $term) {
            return $term->name;
            break;
        }
    endif;
}

require get_template_directory() . '/inc/widget.php';
// conteudo para users logados
require get_template_directory() . '/inc/error_login.php';
function theme($arg = '')
{
    $theme = get_template_directory_uri();
    if (!empty($arg)) {
        $theme .= $arg;
    }
    return $theme;
}

function terms($taxonomy)
{
    global $post;
    $terms = get_the_terms($post->ID, $taxonomy);
    if ($terms && !is_wp_error($terms)) :
        $links = array();
        foreach ($terms as $term) {
            $links[] = $term->name;
        }
        $the_terms = join(", ", $links);
        return $the_terms;
    endif;
}

function escape_terms($taxonomy, $type = '')
{
    global $post;
    $terms = get_the_terms($post->ID, $taxonomy);
    if ($terms && !is_wp_error($terms)) :
        $links = array();
        foreach ($terms as $term) {
            if (empty($type)) {
                $links[] = $term->slug;
            } elseif ($type == 'name') {
                $links[] = $term->name;
            }
        }
        $the_terms = join(", ", $links);
        return $the_terms;
    endif;
}

function top_term($taxonomy, $echo = '')
{
    global $post;
    $terms = get_the_terms($post->ID, $taxonomy);
    if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $parent = $term->parent;
            if ($parent == '0') {
                if (empty($echo)) {
                    echo $term->name;
                } elseif ($echo == 'a') {
                    echo '<a class="top_term_link" href="' . get_term_link($term, $taxonomy) . '">' . $term->name . '</a>';
                } elseif ($echo == 'slug') {
                    echo $term->slug;
                } elseif ($echo == 'return_slug') {
                    return $term->slug;
                } elseif ($echo == 'return') {
                    return $term->name;
                }
            }
        }
    }
}

function child_term($taxonomy, $echo = '')
{
    global $post;
    $terms = get_the_terms($post->ID, $taxonomy);
    if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $parent = $term->parent;
            if (!$parent == '0') {
                if (empty($echo)) {
                    echo $term->name;
                } elseif ($echo == 'a') {
                    echo '<a class="top_term_link" href="' . get_term_link($term, $taxonomy) . '">' . $term->name . '</a>';
                } elseif ($echo == 'slug') {
                    echo $term->slug;
                } elseif ($echo == 'return_slug') {
                    return $term->slug;
                } elseif ($echo == 'return') {
                    return $term->name;
                }
            } else {
                return false;
            }
        }
    }
}

function cpt_name()
{
    global $post;
    $obj = get_post_type_object(get_post_type($post));
    echo $obj->labels->name;
}

/**
 * Custom logo login.
 */
add_action('login_head', 'custom_logo_login');
function custom_logo_login()
{
    echo '
	<style type="text/css">
		body.login div#login {
			padding: 5% 0 0;
		}
		body.login div#login h1 {
			text-align: center;
			margin: 0 auto;
		}
		body.login div#login h1, body.login div#login h1 a {
			width: 230px;
			height: 230px;
		}
		body.login div#login h1 a {
			background-image: url( ' . get_bloginfo('template_directory') . '/img/logo-polis-login.png) !important;
			padding: 0;
			background-size: 230px 230px;
		}
	</style>
	';
}

function biblioteca_count($area)
{
    $key = (isset($_GET['key'])) ? $_GET['key'] : '';
    $tipo = (isset($_GET['tipo'])) ? $_GET['tipo'] : '';
    $cat = (isset($_GET['cat'])) ? $_GET['catf'] : '';
    $categoria = (isset($_GET['categoria'])) ? $_GET['categoria'] : '';
    $anomin = (isset($_GET['anomin'])) ? $_GET['anomin'] : '';
    $anomax = (isset($_GET['anomax'])) ? $_GET['anomax'] : '';
    $categoria_query = array();
    if (!empty($categoria)) {
        $categoria_query = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'areas',
                'field' => 'slug',
                'terms' => $area
            ),
            array(
                'taxonomy' => 'areas',
                'field' => 'slug',
                'terms' => $categoria,
            ),
        );
    } else {
        $categoria_query = array(
            array(
                'taxonomy' => 'areas',
                'field' => 'slug',
                'terms' => $area
            ),
        );
    }
    $date_query = array();
    if (!empty($anomin) && !empty($anomax)) {
        $date_query = array(
            array(
                'after' => array(
                    'year' => (int)$anomin,
                    'month' => 12
                ),
                'before' => array(
                    'year' => (int)$anomax,
                    'month' => 12
                ),
            )
        );
    } elseif (!empty($anomin) && empty($anomax)) {
        $date_query = array(
            array(
                'after' => array(
                    'year' => (int)$anomin,
                    'month' => 12
                ),
            )
        );
    } elseif (!empty($anomax) && empty($anomin)) {
        $date_query = array(
            array(
                'before' => array(
                    'year' => (int)$anomax,
                    'month' => 12
                ),
            )
        );
    }

    $count_args = array(
        'post_type' => 'publicacoes',
        'tax_query' => $categoria_query,
        'tipos' => $tipo,
        'categorias' => $cat,
        's' => $key,
        'date_query' => $date_query,
        'post_per_page' => 999999,
    );
    $count_query = new WP_Query($count_args);
    $count = $count_query->found_posts;
// grab the current page number and set to 1 if no page number is set
    $total_posts = $count;
    return $count;
}

remove_action('profile_personal_options', 'profile_personal_options');
remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');
//avatar by acf
require get_template_directory() . '/inc/avatar.php';


/*
* Add Event Column
*/
function polis_users_column($cols)
{
    $cols['user_noticias'] = 'Notícias';
    $cols['user_publicacoes'] = 'Publicações';
    $cols['user_acoes'] = 'Ações';
    return $cols;
}

/*
* Print Event Column Value  
*/
function polis_user_column_value($value, $column_name, $id)
{
    if ($column_name == 'user_noticias') {
        global $wpdb;
        $count = (int)$wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(ID) FROM $wpdb->posts WHERE
	    post_type = 'noticias' AND post_status = 'publish' AND post_author = %d",
            $id
        ));
        return $count;
    }
    if ($column_name == 'user_publicacoes') {
        global $wpdb;
        $count = (int)$wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(ID) FROM $wpdb->posts WHERE
	    post_type = 'publicacoes' AND post_status = 'publish' AND post_author = %d",
            $id
        ));
        return $count;
    }
    if ($column_name == 'user_acoes') {
        global $wpdb;
        $count = (int)$wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(ID) FROM $wpdb->posts WHERE
	    post_type = 'acoes' AND post_status = 'publish' AND post_author = %d",
            $id
        ));
        return $count;
    }
}

add_filter('manage_users_custom_column', 'polis_user_column_value', 10, 3);
add_filter('manage_users_columns', 'polis_users_column');

function is_area($value)
{
    if ('reforma-urbana' == $value || 'democracia-e-participacao' == $value || 'inclusao-e-sustentabilidade' == $value || 'cidadania-cultural' == $value) {
        return true;
    } else {
        return false;
    }
}

//pagination


//show user id in admin
add_filter('manage_users_columns', 'add_user_id_column');
function add_user_id_column($columns)
{
    $columns['user_id'] = 'ID';
    return $columns;
}

add_action('manage_users_custom_column', 'show_user_id_column_content', 10, 3);
function show_user_id_column_content($value, $column_name, $user_id)
{
    $user = get_userdata($user_id);
    if ('user_id' == $column_name)
        return $user_id;
    return $value;
}


function biblioteca_search_filter($search, $wp_query)
{
    global $wpdb, $_query;

    if (empty($search) || $_query->template != 'biblioteca-search')
        return $search;

    $terms = $wp_query->query_vars['s'];
    $exploded = explode(' ', $terms);
    if ($exploded === FALSE || count($exploded) == 0)
        $exploded = array(0 => $terms);

    $search = '';
    foreach ($exploded as $tag) {
        $search .= " AND (
        ($wpdb->posts.post_title LIKE ‘%$tag%’)
        OR ($wpdb->posts.post_content LIKE ‘%$tag%’)
        OR EXISTS
        (
        SELECT * FROM $wpdb->comments
        WHERE comment_post_ID = $wpdb->posts.ID
        AND ( comment_content LIKE ‘%$tag%’
        OR comment_author LIKE ‘%$tag%’ )
        )
        OR EXISTS
        (
        SELECT * FROM $wpdb->terms
        INNER JOIN $wpdb->term_taxonomy
        ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
        INNER JOIN $wpdb->term_relationships
        ON $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id
        WHERE taxonomy = ‘tag’
        AND object_id = $wpdb->posts.ID
        AND $wpdb->terms.name LIKE ‘%$tag%’
        )
        OR EXISTS
        (
        SELECT * FROM $wpdb->terms
        INNER JOIN $wpdb->term_taxonomy
        ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
        INNER JOIN $wpdb->term_relationships
        ON $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id
        WHERE taxonomy = ‘organizador’
        AND object_id = $wpdb->posts.ID
        AND $wpdb->terms.name LIKE ‘%$tag%’
        )
        )";
    }

    return $search;
}

//add_filter('posts_search', 'biblioteca_search_filter', 500, 2);
