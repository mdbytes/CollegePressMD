<?php

function program_queries($query)
{
    $today = date('Ymd');
    if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
        $query->set('meta-key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
        ));
    }

    if (!is_admin() && is_post_type_archive('program') && $query->is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }

    if (!is_admin() && is_post_type_archive('campus') && $query->is_main_query()) {
        $query->set('posts_per_page', -1);
    }
}


add_action('pre_get_posts', 'program_queries');
