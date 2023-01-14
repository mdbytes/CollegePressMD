<?php
get_header();
page_banner(array(
    'title' => 'Welcome to our blog',
    'subtitle' => 'Our latest news...'
)) ?>

<div class="container container--narrow page-section">
    <div class="generic-content">
        <?php get_search_form(); ?>
    </div>
</div>

<?php get_footer() ?>