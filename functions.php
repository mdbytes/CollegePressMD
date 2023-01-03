<?php

function page_banner($args = NULL)
{
    if (!isset($args['title'])) {
        $args['title'] = get_the_title();
    }

    if (!isset($args['subtitle'])) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if (!isset($args['photo'])) {

        if (get_field('page_banner_background_image') && !is_archive() && !is_home()) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['page-banner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }

?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
            <div class="page-banner__intro">
                <?php echo $args['subtitle']; ?>
            </div>
        </div>
    </div>

<?php
}

function university_files()
{
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('google-font-for-logo', '//fonts.googleapis.com/css2?family=MuseoModerno:ital,wght@0,400;0,500;0,600;0,700;0,800;1,500&display=swap');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features()
{
    register_nav_menu('header-menu-location', 'Header Menu Location');
    register_nav_menu('footer-location-1', 'Footer location 1');
    register_nav_menu('footer-location-2', 'Footer location 2');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professor-landscape', 400, 260, true);
    add_image_size('professor-portrait', 480, 650, true);
    add_image_size('page-banner', 1500, 350, true);
}

add_action('after_setup_theme', 'university_features');

function university_adjust_queries($query)
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
}

add_action('pre_get_posts', 'university_adjust_queries');
