<?php

function professor_like_route()
{
    register_rest_route('college/v1', 'manageLike', array(
        'methods' => 'POST',
        'callback' => 'create_like'
    ));

    register_rest_route('college/v1', 'manageLike', array(
        'methods' => 'DELETE',
        'callback' => 'delete_like'
    ));
}


add_action('rest_api_init', 'professor_like_route');

function create_like($data)
{


    if (is_user_logged_in()) {
        $professor =  sanitize_text_field($data['professor_id']);

        $exists = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => array(
                array(
                    'key' => 'liked_professor_id',
                    'compare' => '=',
                    'value' => $professor
                )
            )
        ));

        if ($exists->found_posts == 0 && get_post_type($professor) == 'professor') {
            return wp_insert_post(array(
                'post_type' => 'like',
                'post_status' => 'publish',
                'post_title' => 'Our PHP Create Post Test',
                'meta_input' => array(
                    'liked_professor_id' => $professor
                )
            ));
        }
    } else {
        die("Only logged in users can create a like");
    }
}

function delete_like($data)
{
    $like_id = sanitize_text_field($data['like']);
    if (get_current_user_id() == get_post_field('post_author', $like_id) && get_post_type($like_id) == 'like') {
        wp_delete_post($like_id, true);
        return "Like deleted";
    } else {
        die("You do not have permission to delete that");
    }
}
