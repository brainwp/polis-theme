<?php
function mobile_nav_ajax()
{
    if (isset($_GET['ajaxMobileNav'])) {
        die();
    }
}

add_action('init', 'mobile_nav_ajax', 1);

?>
