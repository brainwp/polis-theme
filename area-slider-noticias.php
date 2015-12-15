<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 29/07/14
 * Time: 11:05
 */ ?>
<?php
$terms = terms('areas');
$terms = explode(',', $terms);
?>
<li class="item item-slider noticias ajax-item-noticias" style="float:left">
    <div class="post_container">
        <div class="thumb">
            <div class="caption-container">
                <small class="caption"><?php echo $terms[0]; ?></small>
            </div>

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
            <span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span>
            <a class="leia bg-<?php echo sanitize_title( $terms[0] ); ?>" href="<?php the_permalink(); ?>">Leia mais</a>
        </div><!-- .footer-item -->
    </div><!-- post_container .item-slider -->
</li>
