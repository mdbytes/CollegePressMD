<?php

function redirect_subs_to_frontend()
{
    $current_user = wp_get_current_user();

    if (count($current_user->roles) == 1 && $current_user->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}
add_action('admin_init', 'redirect_subs_to_frontend');
