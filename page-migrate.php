<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06/08/14
 * Time: 17:32
 */
// WP_Query arguments
global $wpdb;
$args = array (
    'post_type'              => array('publicacoes'),
    'posts_per_page'         => '999999999999',
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $post_id = get_the_ID();
        $field_content = get_the_content();
        $content = wp_strip_all_tags($field_content);
        $content .= ','.escape_terms('tag', 'name');
        $content .= ','.escape_terms('autor', 'name');
        $content .= ','.escape_terms('organizador', 'name');

        $wpdb->update($wpdb->posts, array('post_content' => $content), array('id' => $post_id));
        update_post_meta($post_id, 'publicacoes_content', $field_content);
    }
    echo 'sucesso?';
}
?>