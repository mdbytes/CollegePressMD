<?php

function nav_menus()
{
    register_nav_menu('header-menu-location', 'Header Menu Location');
    register_nav_menu('footer-location-1', 'Footer location 1');
    register_nav_menu('footer-location-2', 'Footer location 2');
}

add_action('setup_theme_menus', 'nav_menus');
