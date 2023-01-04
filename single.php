<?php
get_header();
while (have_posts()) {
    the_post();
    page_banner();

    if (get_post_type() == 'program') {
        get_template_part('template-parts/single/program');
    } else if (get_post_type() == 'campus') {
        get_template_part('template-parts/single/campus');
    } else if (get_post_type() == 'event') {
        get_template_part('template-parts/single/event');
    } else if (get_post_type() == 'professor') {
        get_template_part('template-parts/single/professor');
    } else {
        get_template_part('template-parts/single/index');
    }
}
get_footer();
