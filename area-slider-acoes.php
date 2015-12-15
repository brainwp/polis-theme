<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 29/07/14
 * Time: 12:25
 */
$t = top_term('areas', 'return_slug'); ?>
<li class="item item-slider ajax-item-acoes">
    <div class="post_container">
        <div class="thumb">
            <a href="<?php the_permalink(); ?>">
                <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('medium');
                } else {
                    echo '<img src="' . theme() . '/img/thumb-equipe.png">';
                } ?>
            </a>
        </div><!-- thumb -->
        <div class="col-md-12 description">
            <h3><?php the_title(); ?></h3>
            <?php echo resumo( '150' ); ?>
        </div><!-- .description -->
        <div class="footer-item">
            <a class="leia bg-<?php echo $t; ?>" href="<?php the_permalink(); ?>">Leia mais</a>
        </div><!-- .footer-item -->
    </div><!-- post_container .item-slider -->
</li>