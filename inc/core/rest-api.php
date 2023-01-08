<?php

add_action('rest_api_init', 'theme_custom_rest');

function theme_custom_rest()
{
    register_rest_field('post', 'authorName', array(
        'get_callback' => function () {
            return get_the_author();
        }
    ));

    register_rest_field('page', 'authorName', array(
        'get_callback' => function () {
            return get_the_author();
        }
    ));

    register_rest_route('college-rest-api/v1', 'search', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'college_search_results'
    ));
}

function college_search_results($data)
{
    $main_query = new WP_Query(array(
        'post_type' => array('post', 'page', 'professor', 'program', 'campus', 'event'),
        's' => sanitize_text_field($data['term'])
    ));

    $results = array(
        'generalInfo' => array(),
        'professors' => array(),
        'programs' => array(),
        'events' => array(),
        'campuses' => array()
    );

    while ($main_query->have_posts()) {
        $main_query->the_post();

        if (get_post_type() == 'post' || get_post_type() == 'page') {
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_the_author()
            ));
        }
        if (get_post_type() == 'professor') {
            array_push($results['professors'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
            ));
        }
        if (get_post_type() == 'program') {
            $related_campuses = get_field('related_campus');
            if ($related_campuses) {
                foreach ($related_campuses as $campus) {
                    array_push($results['campuses'], array(
                        'title' => get_the_title($campus),
                        'url' => get_the_permalink($campus)
                    ));
                }
            }
            array_push($results['programs'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
                'id' => get_the_id()
            ));
        }
        if (get_post_type() == 'event') {
            $event_date = new DateTime(get_field('event_date'));
            $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 15);
            array_push($results['events'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
                'month' => $event_date->format('M'),
                'day' => $event_date->format('d'),
                'excerpt' => $excerpt
            ));
        }
        if (get_post_type() == 'campus') {
            array_push($results['campuses'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink()
            ));
        }
    }

    if ($results['programs']) {

        $programs_meta_query = array('relation' => 'OR');
        foreach ($results['programs'] as $program) {
            array_push($programs_meta_query, array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . $program['id'] . '"'
            ));
        }

        $program_relationship_query = new WP_Query(array(
            'post_type' => array('professor', 'event'),
            'meta_query' => $programs_meta_query
        ));

        while ($program_relationship_query->have_posts()) {
            $program_relationship_query->the_post();
            if (get_post_type() == 'professor') {
                array_push($results['professors'], array(
                    'title' => get_the_title(),
                    'url' => get_the_permalink(),
                    'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
                ));
            }
            if (get_post_type() == 'event') {
                $event_date = new DateTime(get_field('event_date'));
                $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 15);
                array_push($results['events'], array(
                    'title' => get_the_title(),
                    'url' => get_the_permalink(),
                    'month' => $event_date->format('M'),
                    'day' => $event_date->format('d'),
                    'excerpt' => $excerpt
                ));
            }
        }

        $results['professors'] = array_values(array_unique($results['professors'], SORT_REGULAR));
        $results['events'] = array_values(array_unique($results['events'], SORT_REGULAR));
    }

    return $results;
}
