<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 29/07/14
 * Time: 12:08
 */
$t = top_term('areas', 'return_slug');
$post_id =  get_the_ID();
?>
<li class="item item-slider publicacoes ajax-item-publicacoes">
    <div class="post_container" data-data-data="true">
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
        </div><!-- .description -->
        <div class="footer-item">
            <?php
            $download_id = get_field('publicacoes_download', $post_id);
            if( !empty( $download_id ) ): ?>
                <?php
                $download_url = wp_get_attachment_url( $download_id );
                $download_title = get_the_title( $download_id );
                $file = substr( $download_url, strrpos( $download_url, '/' ) +1 );
                $size = number_format( filesize( get_attached_file( $download_id ) ) / 1048576, 2 ) . "mb";
                ?>
                <a class="leia bg-<?php echo $t; ?>" href="<?php echo $download_url; ?>" download="<?php echo $file; ?>">Download • <?php echo $size; ?></a>
            <?php endif; ?>

            <?php if( get_field('mgr_pub_download', $post_id) && empty( $download_id ) ): ?>
                <?php
                $mgr_download = get_campoPersonalizado('mgr_pub_download');
                $explode_download = explode( '.', $mgr_download );
                ?>
                <a class="leia download bg-<?php echo $t; ?>" href="http://www.polis.org.br/uploads/<?php echo $explode_download[0] . "/" . $mgr_download; ?>" download="<?php echo $mgr_download; ?>">Download</a>
            <?php endif; ?>
            <a class="leia bg-<?php echo $t; ?>" href="<?php the_permalink(); ?>">Leia mais</a>
        </div><!-- .footer-item -->
    </div><!-- post_container .item-slider -->
</li>
