<?php


function theme_header_url()
{
    return esc_url(site_url('/'));
}

add_filter('login_headerurl', 'theme_header_url');

function theme_login_css()
{
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('google-font-for-logo', '//fonts.googleapis.com/css2?family=MuseoModerno:ital,wght@0,400;0,500;0,600;0,700;0,800;1,500&display=swap');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', THEME_URI . '/assets/build/style-index.css');
    wp_enqueue_style('university_extra_styles', THEME_URI . '/assets/build/index.css');
}

add_action('login_enqueue_scripts', 'theme_login_css');

function theme_login_title()
{
    return get_bloginfo('name');
}

add_filter('login_headertitle', 'theme_login_title');
