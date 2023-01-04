<?php

function theme_features()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

add_action('setup_theme_features', 'theme_features');
