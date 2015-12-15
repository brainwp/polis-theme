<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 27/05/14
 * Time: 16:04
 */
global $_query;
$page = $_query->_page;
$total_pages = $_query->total_pages;
get_header(); ?>

    <div class="header-area col-md-12 equipe">
        <h1>Equipe</h1>
    </div><!-- header-area col-md-12 equipe -->

    <section class="col-md-12 content equipe" id="equipe_load" data-ajax="true">
    </section>
    <img id="load_ajax_icon" src="<?php bloginfo('template_url');?>/img/ajax-loader.gif" align="center" width="64" height="64">

<?php get_footer(); ?>