<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15/08/14
 * Time: 14:12
 */
function escape_terms_onsave($post_id, $taxonomy, $type = '')
{
    $post = get_post($post_id);
    $terms = get_the_terms($post->ID, $taxonomy);
    if ($terms && !is_wp_error($terms)) :
        $links = array();
        foreach ($terms as $term) {
            if (empty($type)) {
                $links[] = $term->slug;
            } elseif ($type == 'name') {
                $links[] = $term->name;
            }
        }
        $the_terms = join(", ", $links);
        return $the_terms;
    endif;
}

add_action( 'save_post_publicacoes', 'publicacoes_save' );
function publicacoes_save($post_id){
    global $wpdb;
    $field_content = $_POST['fields']['field_content_publicacoes'];
    $content = wp_strip_all_tags($field_content);
    $content .= ','.escape_terms_onsave($post_id, 'tag', 'name');
    $content .= ','.escape_terms_onsave($post_id, 'autor', 'name');
    $content .= ','.escape_terms_onsave($post_id, 'organizador', 'name');

    $wpdb->update($wpdb->posts, array('post_content' => $content), array('id' => $post_id));
}