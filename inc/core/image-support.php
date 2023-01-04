<?php

function image_support()
{
    add_image_size('professor-landscape', 400, 260, true);
    add_image_size('professor-portrait', 480, 650, true);
    add_image_size('page-banner', 1500, 350, true);
}

add_action('setup_image_support', 'image_support');
