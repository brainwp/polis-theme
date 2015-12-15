<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 03/06/14
 * Time: 10:29
 */
get_header('mini');
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main biblioteca-main first" role="main">
        <div class="col-md-12 header-area">
            <div class="col-md-7 pull-left">
                <h1>Biblioteca</h1>

                <p><?php echo of_get_option('biblioteca-intro'); ?></p>
            </div>
        </div>
        <?php get_template_part('inc/biblioteca', 'search'); ?>
        <div id="biblioteca-require-position"></div>
        <div class="col-md-12 biblioteca livros_section" id="biblioteca-require" style="display:none">
            <div class="col-md-6 col-md-offset-3 biblioteca-require">
                Escolha uma dessas áreas para ver os resultados de sua busca
            </div>
        </div>
        <?php get_template_part('biblioteca','sliders');?>
    </main>
<?php get_footer(); ?>
