<?php

function no_subs_admin_bar()
{
    $current_user = wp_get_current_user();
    if (count($current_user->roles) == 1 && $current_user->roles[0] == 'subscriber') {
        add_filter('show_admin_bar', '__return_false');
    }
}
add_action('wp_loaded', 'no_subs_admin_bar');
