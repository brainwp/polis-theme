<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/07/14
 * Time: 12:42
 */
class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {

    function start_lvl($output, $depth) {    }

    function end_lvl($output, $depth) {    }

    function start_el($output, $item, $depth, $args) {
        // Here is where we create each option.
        $item_output = '';

        // add spacing to the title based on the depth
        $item->title = str_repeat("&amp;nbsp;", $depth * 4) . $item->title;

        // Get the attributes.. Though we likely don't need them for this...
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' value="'   . esc_attr( $item->url        ) .'"' : '';

        // Add the html
        $item_output .= '<option'. $attributes .'>';
        $item_output .= apply_filters( 'the_title_attribute', $item->title );

        // Add this new item to the output string.
        $output .= $item_output;

    }

    function end_el($output, $item, $depth) {
        // Close the item.
        $output .= "</option>\n";

    }

}

