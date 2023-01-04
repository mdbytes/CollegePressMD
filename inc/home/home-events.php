<?php

function home_events()
{
    $today = date('Ymd');
    $home_page_events = new WP_Query(array(
        'posts_per_page' => 2,
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
        ),
    ));

    while ($home_page_events->have_posts()) {
        $home_page_events->the_post();
        get_template_part('template-parts/content', 'event');
    }
    wp_reset_postdata();
}
