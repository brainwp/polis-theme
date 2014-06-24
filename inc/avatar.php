<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 24/06/14
 * Time: 11:57
 */
add_filter( 'get_avatar' , 'remove_gravatar' , 1 , 4 );

function remove_gravatar( $avatar, $id_or_email, $size ) {
    $user = false;

    if ( is_numeric( $id_or_email ) ) {

        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );

    } elseif ( is_object( $id_or_email ) ) {

        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }

    } else {
        $user = get_user_by( 'email', $id_or_email );
    }
    if ( $user && is_object( $user ) ) {
        $_avatar = get_field('user_avatar', 'user_'.$user->id);
        if(!empty($_avatar)){
            if($size == 26 || $size == '26' || $size == 64 || $size == '64'){
                $_avatar = get_field('user_avatar', 'user_'.$user->id);
                    $avatar_src = wp_get_attachment_image_src($_avatar, 'thumbnail');
                    $avatar_src = $avatar_src[0];
                    $avatar = '<img src="'.$avatar_src.'" width="'.$size.'" height="'.$size.'" class="avatar avatar-'.$size.' photo" >';
            }
            else{
                $_avatar = get_field('user_avatar', 'user_'.$user->id);
                    $avatar_src = wp_get_attachment_image_src($_avatar, 'medium');
                    $avatar_src = $avatar_src[0];
                    $avatar = '<img src="'.$avatar_src.'" width="'.$size.'" height="'.$size.'" class="avatar avatar-'.$size.' photo" >';
            }
        }
    }
    return $avatar;
}
