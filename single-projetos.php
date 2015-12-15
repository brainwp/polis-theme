<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Polis Theme
 */

get_header(); ?>

<main id="main" class="site-main projetos-main" role="main">

<div class="header-area single-projetos ol-md-12">
    <h1>Projeto</h1>
</div><!-- header-area col-md-12 projetos-main -->

    <section class="col-md-12 content-single <?php top_term( 'categorias', 'slug' ); ?>">

        <?php while ( have_posts() ) : the_post(); ?>

        <article class="col-md-8 pull-left">
            <h1><?php the_title(); ?></h1>
            
            <div class="thumb">
                <?php if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'single-noticias-thumb' );
                } else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/default700x200.jpg" alt="<?php the_title(); ?>" />
                <?php } ?>
            </div><!-- thumb -->

            <?php the_content(); ?>
        </article>
        <aside class="col-md-4 pull-right sidebar-page">

             <div class="col-lg-12 clear"></div>
            <?php if (get_field('projetos_repeater')): ?>
            <aside class="equipe">
                <div class="top">
                    <a href="<?php the_permalink(); ?>#equipe_todos" class="detalhes">Equipe</a>
                </div>
                <ul>
                        <?php $_repeater_i = 1; ?>
                        <?php while (has_sub_field('projetos_repeater')): ?>
                            <?php
                            if($_repeater_i <= 4){
                                $user = get_user_by( 'email', get_sub_field('projetos_email') );
                                if($user){
                                    $href = get_bloginfo('url') . '/equipe/' . $user->user_login;
                                    echo '<li><a href="' . $href . '"> ' . get_sub_field('projetos_nome') . ' </a></li>';
                                }
                                else{
                                    echo '<li><a> ' . get_sub_field('projetos_nome') . ' </a></li>';
                                }
                                $_repeater_i++;
                            }
                            ?>
                        <?php endwhile; ?>
                </ul>
            </aside>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'widgets-institucional' ) ) : ?>
                <?php dynamic_sidebar( 'widgets-institucional' ); ?>
            <?php endif; ?>
        </aside>
        <?php endwhile; // end of the loop. ?>

    </section>

<section class="col-md-12 slider-single-areas projetos-single">

    <h2>Outros Projetos</h2>

    <div id="carousel" class="col-md-12 list_carousel responsive">
        <?php
        $arg = array(
            'post_type' => array('projetos'),
            'orderby' => 'date',
            'order' => 'DESC',
            'post__not_in' => array($single_id),
            'posts_per_page' => 15
        );?>
        <ul id="slider2">
            <?php
            $publicacoes = new WP_Query($arg); ?>
            <?php while ($publicacoes->have_posts()) :
                $publicacoes->the_post(); ?>
                <li class="item">
                    <a href="<?php the_permalink(); ?>">

                        <div class="hover"></div>

                        <?php
                        if (has_post_thumbnail()) {
                            $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider-publicacoes-thumb', true);
                            echo '<img src="' . $thumb_url[0] . '"/>';
                        } else {
                            echo '<img src="' . get_bloginfo('template_url') . '/img/default-publicacoes-thumb.jpg " />';
                        }
                        ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <!-- carousel -->

    <div id="prev-publicacao" class="prev"></div>
    <div id="next-publicacao" class="next"></div>

    <div class="clear"></div>

    <div class="todos-full"><a class="btn-todos-full" href="<?php echo home_url(); ?>/biblioteca">Veja todas as
            publicações ou faça uma busca</a></div>

</section>
</main>
<?php get_footer(); ?>