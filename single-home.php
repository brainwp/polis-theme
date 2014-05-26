<?php

    /*
    Template Name: single-home
    */

?>    

<?php

    $post = get_post($_POST['id']);

?>

    <!--single-home-->
    <div id="single-home post-<?php the_ID(); ?>">

    <!--single-home-bg-->
    <div class="single-home-bg">

    </div>
    <!--single-home-bg-->

    <?php while (have_posts()) : the_post(); ?>

        <!--sh-image-->
        <div class="sh-image">

            <?php the_post_thumbnail(); ?>

        </div>
        <!--sh-image-->

        <!--sh-post-->
        <div class="sh-post">

            <!--sh-cat-date-->
            <div class="sh-cat-date">

                <?php

                    $category = get_the_category(); 
                    echo $category[0]->cat_name;

                ?>

                - <?php the_time('l, F jS, Y') ?>

            </div>
            <!--sh-cat-date-->

            <!--sh-title-->
            <div class="sh-title">

                <?php the_title();?>

            </div>
            <!--sh-title-->

            <!--sh-excerpt-->
            <div class="sh-excerpt">

                <?php the_excerpt();?>

            </div>
            <!--sh-excerpt-->

            <!--sh-content-->
            <div class="sh-content">

                <?php the_content();?>

            </div>
            <!--sh-content-->

    </div>
    <!--sh-post-->        

    <?php endwhile;?>

    <div class="clearfix"></div>    

    </div>
    <!--single-home-->