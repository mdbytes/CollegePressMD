<?php

/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CollegePressMD
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('THEME_DIR', get_template_directory());
define('THEME_URI', esc_url(get_template_directory_uri()));

/**
 * Theme features
 */
require_once THEME_DIR . '/inc/core/theme-features.php';

/**
 * Theme scripts
 */
require_once THEME_DIR . '/inc/core/theme-scripts.php';

/**
 * Theme nav menu locations
 */
require_once THEME_DIR . '/inc/core/nav-menu.php';

/**
 * Theme functionality: Image support
 */
require_once THEME_DIR . '/inc/core/image-support.php';

/**
 * Theme functionality: Post types
 */
require_once THEME_DIR . '/inc/types/post-types.php';

/**
 * Theme functionality: REST API
 */
require_once THEME_DIR . '/inc/rest/rest-api.php';
require_once THEME_DIR . '/inc/rest/like-route.php';

/**
 * Theme functionality: Adjust queries as needed
 */
require_once THEME_DIR . '/inc/campus/queries.php';
require_once THEME_DIR . '/inc/event/queries.php';
require_once THEME_DIR . '/inc/program/queries.php';

/**
 * Theme functionality: Set up Google map key
 */
require_once THEME_DIR . '/inc/campus/map-key.php';

/**
 * Theme utilities
 */

/**
 * Page banner utility
 */
require_once THEME_DIR . '/inc/core/page-banner.php';

/**
 * Home page functionality
 */
require_once THEME_DIR . '/inc/home/home-posts.php';
require_once THEME_DIR . '/inc/home/home-events.php';


/**
 * Redirect subscribers on login
 */
function redirect_subs_to_frontend()
{
    $current_user = wp_get_current_user();

    if (count($current_user->roles) == 1 && $current_user->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}
add_action('admin_init', 'redirect_subs_to_frontend');

function no_subs_admin_bar()
{
    $current_user = wp_get_current_user();
    if (count($current_user->roles) == 1 && $current_user->roles[0] == 'subscriber') {
        add_filter('show_admin_bar', '__return_false');
    }
}
add_action('wp_loaded', 'no_subs_admin_bar');


/**
 * Customize login screen
 */
function theme_header_url()
{
    return esc_url(site_url('/'));
}

add_filter('login_headerurl', 'theme_header_url');

function theme_login_css()
{
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('google-font-for-logo', '//fonts.googleapis.com/css2?family=MuseoModerno:ital,wght@0,400;0,500;0,600;0,700;0,800;1,500&display=swap');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', THEME_URI . '/assets/build/style-index.css');
    wp_enqueue_style('university_extra_styles', THEME_URI . '/assets/build/index.css');
}

add_action('login_enqueue_scripts', 'theme_login_css');

function theme_login_title()
{
    return get_bloginfo('name');
}

add_filter('login_headertitle', 'theme_login_title');


// Force note posts to be private
function make_note_private($data, $postarr)
{
    if ($data['post_type'] == 'note') {
        if (count_user_posts(get_current_user_id(), 'note')  > 4 && !$postarr['ID']) {
            die('You have reached your note limit');
        }

        $data['post_content'] = sanitize_textarea_field($data['post_content']);
        $data['post_title'] = sanitize_text_field($data['post_title']);
    }

    if ($data['post_type'] == 'note' && $data['post_status'] != 'trash') {
        $data['post_status'] = "private";
    }
    return $data;
}
