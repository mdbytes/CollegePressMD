<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Event Home</a> <span class="metabox__main"><?php the_title(); ?></span>
        </p>
    </div>


    <div class="generic-content">
        <div class="row group">
            <div class="one-third"><?php the_post_thumbnail('professor-portrait') ?></div>
            <div class="two-thirds">
                <?php
                $like_count = new WP_Query(array(
                    'post_type' => 'like',
                    'meta_query' => array(
                        array(
                            'key' => 'liked_professor_id',
                            'compare' => '=',
                            'value' => get_the_ID()
                        )
                    )
                ));

                $you_like_status = "no";

                if (is_user_logged_in()) {
                    $exists = new WP_Query(array(
                        'author' => get_current_user_id(),
                        'post_type' => 'like',
                        'meta_query' => array(
                            array(
                                'key' => 'liked_professor_id',
                                'compare' => '=',
                                'value' => get_the_ID()
                            )
                        )
                    ));

                    if ($exists->found_posts) {
                        $you_like_status = "yes";
                    }
                }



                if (is_user_logged_in()) {
                ?>

                    <span class="like-box" data-professor="<?php the_ID() ?>" data-like="<?php echo $exists->found_posts ?  $exists->posts[0]->ID : ""; ?>" data-exists="<?php echo $you_like_status ?>">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <span class="like-count"><?php echo $like_count->found_posts ?></span>
                    </span>
                <?php
                }
                the_content();
                ?>

            </div>
        </div>
    </div>

    <?php
    $related_programs = get_field('related_programs');

    if ($related_programs) {
        echo '<hr class="section-break';
        echo '<h2 class="headline headline-medium">Subjects Taught</h2>';
        echo "<ul class='link-list min-list'>";
        foreach ($related_programs as $program) {

    ?>
            <li><a href="<?php echo get_the_permalink($program) ?>"><?php echo get_the_title($program); ?></a></li>


    <?php
        }
        echo "</ul>";
    }
    ?>

</div>