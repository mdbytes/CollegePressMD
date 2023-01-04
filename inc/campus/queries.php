<?php

function campus_queries($query)
{
    if (!is_admin() && is_post_type_archive('campus') && $query->is_main_query()) {
        $query->set('posts_per_page', -1);
    }
}

add_action('pre_get_posts', 'campus_queries');
