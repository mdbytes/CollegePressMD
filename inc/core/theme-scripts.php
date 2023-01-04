<?php

function theme_scripts()
{
    wp_enqueue_script('google-map-js', '//maps.googleapis.com/maps/api/js?key=AIzaSyCEA-yi8uLvczzjB-7tJ83IZkXODuAh7QI', NULL, '1.0', true);
    wp_enqueue_script('main-university-js', THEME_URI . '/assets/build/index.js', array('jquery'), '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('google-font-for-logo', '//fonts.googleapis.com/css2?family=MuseoModerno:ital,wght@0,400;0,500;0,600;0,700;0,800;1,500&display=swap');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', THEME_URI . '/assets/build/style-index.css');
    wp_enqueue_style('university_extra_styles', THEME_URI . '/assets/build/index.css');
}

add_action('wp_enqueue_scripts', 'theme_scripts');
