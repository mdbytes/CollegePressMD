<?php

function google_map_key($api)
{
    $api['key'] = 'AIzaSyCEA-yi8uLvczzjB-7tJ83IZkXODuAh7QI';
    return $api;
}

add_filter('acf/fields/google_map/api', 'google_map_key');
