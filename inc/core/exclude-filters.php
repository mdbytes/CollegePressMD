<?php

function ai1wm_exclude_filters($exclude_filters)
{
    $exclude_filters[] = 'themes/PrimalPressMD/assets/node_modules';
    return $exclude_filters;
}

add_filter('ai1wm_exclude_content_from_export', 'ai1wm_exclude_filters');
