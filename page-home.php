<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 22/05/14
 * Time: 11:10
 */
get_header(); ?>
    <section class="col-md-12 content text-center">
        <p class="description">
            <?php
                $intro = of_get_option('frase-intro-home');
                $beta = of_get_option('frase-intro-beta');
                if ( !empty( $beta ) ) {
                    echo $beta;
                } else {
                    echo $intro;
                }
             ?>
        </p><!-- description -->

        <p class="description title-home">
            Áreas de Atuação
        </p>
    </section>
    <section class="col-md-12 content atuacao">
        <div class="col-md-6 left">
            <div class="col-md-12 hover hover-reforma active" data-bg="<?php echo get_template_directory_uri();?>/img/home-bg-reforma.jpg" data-href="<?php echo home_url(); ?>/area/reforma-urbana">
                <img src="<?php echo get_template_directory_uri();?>/img/home-bg-reforma.jpg" style="display:none;">
                <div class="col-md-7 reforma">
                    <p class="title">Reforma Urbana</p>

                    <div class="col-md-12 description">
                        <?php echo of_get_option('frase-reformaurbana-home'); ?>
                    </div>
                    <a class="col-md-5 saiba left text-center" href="<?php echo home_url(); ?>/area/reforma-urbana">Saiba mais</a>
                </div>
            </div><!-- .col-md-12 hover hover-reforma -->
            <div class="col-md-12 hover hover-inclusao active" data-bg="<?php echo get_template_directory_uri();?>/img/home-bg-inclusao.jpg" data-href="<?php echo home_url(); ?>/area/inclusao-e-sustentabilidade">
                <img src="<?php echo get_template_directory_uri();?>/img/home-bg-inclusao.jpg" style="display:none;">
                <div class="col-md-7 inclusao">
                    <p class="title">Inclusão e Sustentabilidade</p>
                    <div class="col-md-12 description">
                        <?php echo of_get_option('frase-inclusao-home'); ?>
                    </div>
                    <a class="col-md-5 saiba left text-center" href="<?php echo home_url(); ?>/area/inclusao-e-sustentabilidade">Saiba mais</a>
                </div>
            </div><!-- .col-md-12 hover hover-inclusao -->
        </div>
        <div class="col-md-6 pull-right right">
            <div class="hover hover-democracia active" data-bg="<?php echo get_template_directory_uri();?>/img/home-bg-democracia.jpg" data-href="<?php echo home_url(); ?>/area/democracia-e-participacao">
                <img src="<?php echo get_template_directory_uri();?>/img/home-bg-democracia.jpg" style="display:none;">
                <div class="col-md-7 democracia pull-right right">
                    <p class="title">Democracia e Participação</p>

                    <p class="description">
                        <?php echo of_get_option('frase-democracia-home'); ?>
                    </p>
                    <a class="col-md-5 saiba left text-center" href="<?php echo home_url(); ?>/area/democracia-e-participacao">Saiba mais</a>
                </div>
            </div><!-- .hover hover-democracia -->
            <div class="hover hover-cidadania active" data-bg="<?php echo get_template_directory_uri();?>/img/home-bg-cidadania.jpg" data-href="<?php echo home_url(); ?>/area/cidadania-cultural">
                <img src="<?php echo get_template_directory_uri();?>/img/home-bg-cidadania.jpg" style="display:none;">
                <div class="col-md-6 cidadania pull-right right">
                    <p class="title">Cidadania Cultural</p>

                    <p class="description">
                        <?php echo of_get_option('frase-cidadania-home'); ?>
                    </p>
                    <a class="col-md-5 saiba left text-center" href="<?php echo home_url(); ?>/area/cidadania-cultural">Saiba mais</a>
                </div>
            </div><!-- .hover hover-cidadania -->
        </div>
        <div class="col-md-12 clear"></div>
        <div class="col-md-10 col-md-offset-1 consultoria-alert">
            <img src="<?php bloginfo('template_url'); ?>/img/consultoria-alert.png">
            <!-- trocar pelo png transparente depois -->
            <span>Interessado nos serviços de consultoria do Pólis?</span>
            <a class="pull-right right" href="<?php echo home_url(); ?>/contato">Entre em contato</a>
        </div>

        <div class="linha-tracejada"></div>

    </section>
    <section class="col-md-12 content news">
        <div class="col-md-12">
            <div class="section-title">
                <h3>Notícias e Ações</h3>
                <a href="<?php echo home_url('/noticias-e-acoes'); ?>" class="col-md-1 shape-todos">Ver todos</a>
            </div>
        </div>

        <article id="slider-news" class="carousel slide col-md-7" data-ride="carousel">
            <div class="carousel-inner">
                <?php $slider_query = new WP_Query(array(
                    'post_type' => array('acoes', 'noticias'),
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'posts_per_page' => 6,
                    'meta_query' => array(
                        array(
                            'key' => 'in_home_slider',
                            'value' => 'nao',
                            'compare' => '!='
                        ),
                    )
                ));?>
                <?php $_i = 0; ?>
                <?php while ($slider_query->have_posts()) :
                $slider_query->the_post(); ?>
            <?php if ($_i == 0){ ?>
                <div class="item active">
                    <?php
                    }
                    else{
                    ?>
                    <div class="item">
                        <?php } ?>

                        <div class="thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('slider-news-image');
                                } else {
                                    echo '<img src="' . get_bloginfo('template_url') . '/img/default700x200.jpg " />';
                                } ?>
                            </a>
                            <?php $terms = terms('areas'); ?>
                            <?php $class_term = explode(", ", $terms); ?>
                            <?php $bg_term = sanitize_title($class_term[0]); ?>
                            <?php if (!is_area($bg_term)) {
                                $bg_term = 'default';
                            } ?>
                            <div class="news-terms bg-<?php echo $bg_term; ?>">
                                <?php echo $terms; ?>
                            </div>
                        </div>
                        <!-- thumb -->
                        <div class="left type"><?php echo get_post_type(); ?></div>
                        <h3><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
                        </h3>

                        <div class="texto">
                            <span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="more">Leia Mais</a>
                    </div>
                    <?php
                    $_i++;
                    endwhile;
                    ?>
                </div>
                <div id="slider-news-controle" class="pagination">
                    <div class="carousel-indicators">
                        <?php for ($i = 0; $i < 6; $i++) {
                            $visible = $i + 1;
                            if ($i == 0) {
                                echo '<a class="active" href="#slider-news" data-slide-to="' . $i . '">' . $visible . '</a>';
                            } else {
                                echo '<a href="#slider-news" data-slide-to="' . $i . '">' . $visible . '</a>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php wp_reset_postdata(); ?>
        </article>
        <section class="col-md-5 pull-right">
            <?php if (is_active_sidebar('widgets-boletim-home')) : ?>
                <?php dynamic_sidebar('widgets-boletim-home'); ?>
            <?php endif; ?>
            <div class="col-md-12 canal">
                <div class="col-md-6">
                    <p>Canal Pólis</p>
                    Conheça nosso novo canal!
                    <a href="#" class="col-md-8 btn-ao-vivo">Ao vivo</a>
                </div>
                <a href="<?php echo home_url(); ?>/canal" class="full-link"></a>
            </div>
        </section>
    </section>
    <div class="clear-mob"></div>
    <section class="col-md-12 content publicacoes">

        <div class="linha-tracejada"></div>

        <div class="section-title">
            <h3>Publicações</h3>
            <a href="<?php echo home_url(); ?>/publicacoes" class="col-md-1 shape-todos">Ver todas</a>
        </div>
        <div id="hide-ajax" style="display: none"></div>
        <div id="carousel" class="col-md-12 list_carousel responsive">
            <?php $arg = array(
                'post_type' => array('publicacoes'),
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => 15,
                'meta_query' => array(
                    array(
                        'key' => 'in_home_slider',
                        'value' => 'nao',
                        'compare' => '!='
                    ),
                )
            );
            ?>
            <ul id="publicacoes-slider-<?php echo $cat; ?>" class="publicacoes-slider">

                <?php $publicacoes = new WP_Query( $arg ); ?>

                <?php while ($publicacoes->have_posts()) :
                    $publicacoes->the_post(); ?>

                    <?php get_template_part('area-slider','publicacoes'); ?>
                <?php endwhile; ?>

            </ul>
        </div>
        <!-- carousel -->

        <div class="prev-slider acoes-prev-slider" id="prev-biblioteca-series"></div>
        <div class="next-slider acoes-next-slider" id="next-biblioteca-series"></div>
        <div class="clear"></div>

        <div class="todos-full"><a class="btn-todos-full" href="<?php echo home_url(); ?>/biblioteca">Veja todas as
                publicações ou faça uma busca</a></div>

    </section>
    <section class="col-md-12 content widgets-home">

        <div class="linha-tracejada"></div>

    </section>
    <a href="http://polis.org.br/noticias/lancamento-da-alianca-residuo-zero-brasil-tem-presenca-do-professor-paul-connet-da-universidade-st-lawrence-nova-york/"><img class="image-link" src="<?php echo get_template_directory_uri(); ?>/img/paul-connet.jpg" alt="Assista no Canal Pólis"></a>
<?php get_footer(); ?>
