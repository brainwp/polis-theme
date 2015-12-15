<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04/07/14
 * Time: 14:14
 */
?>
<div class="col-md-12 post_content">
    <div class="col-md-3 col-xs-12 pull-left thumb">
        <?php if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'medium' );
        } else { ?>
            <img src="<?php echo get_template_directory_uri(); ?>/img/default-projetos.jpg" alt="<?php the_title(); ?>" />
        <?php } ?>
    </div>
    <div class="col-md-6 post">
        <a class="link" href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
            <span class="text">
                <?php echo resumo('500'); ?>
            </span>
        <a class="leia" href="<?php the_permalink(); ?>">Leia Mais</a>
    </div>
    <div class="col-md-3">
        <a href="<?php the_permalink(); ?>" class="detalhes">Detalhes do Projeto</a>

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
    </div>
</div>