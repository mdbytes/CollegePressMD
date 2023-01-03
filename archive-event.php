<?php get_header();
page_banner(array(
    'title' => 'All Events',
    'subtitle' => 'Our future events...'
));
?>



<div class="container container--narrow page-section">

    <?php
    while (have_posts()) {
        the_post();
    ?>

        <div class="event-summary">
            <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                <span class="event-summary__month"><?php
                                                    $event_date = new DateTime(get_field('event_date'));
                                                    echo $event_date->format('M'); ?></span>
                <span class="event-summary__day"><?php echo $event_date->format('d') ?></span>
            </a>
            <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php echo wp_trim_words(get_the_content(), 15); ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
            </div>
        </div>


    <?php

    }

    echo paginate_links();

    ?>

    <hr class="section-break">
    <p>Looking for a recap of past events? Check out our <a href="<?php echo site_url('/past-events') ?>">past events archive</a> .</p>

</div>

<?php get_footer() ?>