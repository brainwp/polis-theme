<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 22/05/14
 * Time: 11:10
 */
get_header(); ?>
    <section class="col-md-12 intro-institucional">
        <?php while (have_posts()) : the_post(); ?>
            <div class="col-md-8">
                <h1>Institucional</h1>

                <div class="description">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg"></div>
            </div>
        <?php endwhile; ?>
        <div class="col-md-12 triangulo"></div>
    </section>

    <nav class="col-md-12 institucional-nav">
        <?php
        $_id = get_page_by_path('institucional',OBJECT,'page');
        $_id = $_id->ID;
      //  echo '<script>alert('.$_id.')</script>';
        $args = array(
            'meta_key' => 'institucional_order',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'post_type' => 'page',
            'post_parent' => $_id
        );
        $_pages = new WP_Query( $args );
        $_i = 0;
        while ($_pages->have_posts()) :
            $_pages->the_post();
            global $post;
            if ($_i == 0) {
                echo '<a class="link_institucional" id="bt-' . $post->post_name . '" data-id="' . $post->post_name . '" class="atual">' . $post->post_title . '</a>';
                $_first = $post;
            } else {
                echo '<a class="link_institucional" id="bt-' . $post->post_name . '" data-id="' . $post->post_name . '">' . $post->post_title . '</a>';
            }
            $_i++;
        endwhile;
        //echo $_pages->post_count;
        ?>
    </nav>
    <section class="col-md-12 content">
        <article class="col-md-8 pull-left content-institucional" id="post_ajax">
            <ul class="nav nav-tabs tabs-idioma" role="tablist" >
                <li role="presentation" class="active" data-tab-element="#tab-ptbr"><a href="#tab-ptbr" role="tab" data-toggle="tab">Português do Brasil</a></li>
                <li role="presentation" data-tab-element="#tab-es"><a href="#tab-es" role="tab" data-toggle="tab">Espanhol</a></li>
                <li role="presentation" data-tab-element="#tab-es"><a href="#tab-es" role="tab" data-toggle="tab">Inglês</a></li>

            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tab-ptbr">
                    <h1><?php echo get_post_meta( $_first->ID, 'title_ptbr', true ); ?></h1>
                    <?php
                        $content = get_post_meta( $_first->ID, 'content_ptbr', true );
                        $content = apply_filters( 'the_content',  $content);
                        $content = str_replace( ']]>', ']]&gt;', $content );
                        echo $content;
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab-es">
                    <?php if( get_post_meta( $_first->ID, 'active_es', true ) == 'true'): ?>
                        <h1><?php echo get_post_meta( $_first->ID, 'title_es', true ); ?></h1>
                        <?php
                        $content = get_post_meta( $_first->ID, 'content_es', true );
                        $content = apply_filters( 'the_content',  $content);
                        $content = str_replace( ']]>', ']]&gt;', $content );
                        echo $content;
                        ?>
                    <?php endif;?>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab-en">
                    <?php if( get_post_meta( $_first->ID, 'active_en', true ) == 'true'): ?>
                        <h1><?php echo get_post_meta( $_first->ID, 'title_en', true ); ?></h1>
                        <?php
                        $content = get_post_meta( $_first->ID, 'content_en', true );
                        $content = apply_filters( 'the_content',  $content);
                        $content = str_replace( ']]>', ']]&gt;', $content );
                        echo $content;
                        ?>
                    <?php endif;?>
                </div>

            </div>

        </article>
        <aside class="col-md-4 pull-right">
            <?php if (is_active_sidebar('widgets-institucional')) : ?>
                <?php dynamic_sidebar('widgets-institucional'); ?>
            <?php endif; ?>
        </aside>
    </section>
<?php get_footer(); ?>