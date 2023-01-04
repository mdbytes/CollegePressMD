<?php
get_header();

if (is_post_type_archive('program')) {
    get_template_part('template-parts/archive/program');
} else if (is_post_type_archive('event')) {
    get_template_part('template-parts/archive/event');
} else if (is_post_type_archive('campus')) {
    get_template_part('template-parts/archive/campus');
} else {
    get_template_part('template-parts/archive/index');
}

get_footer();
