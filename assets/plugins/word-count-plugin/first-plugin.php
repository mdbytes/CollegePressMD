<?php

/*
  Plugin Name: Word Count Plugin
  Description: A WordPress plugin designed to count words and estimate reading time for posts.
  Version: 1.0
  Author: Martin Dwyer
  Author URI: https://mdbytes.com
*/

class WordCountAndTimePlugin
{
    function __construct()
    {
        add_action('admin_menu', array($this, 'admin_page'));
        add_action('admin_init', array($this, 'settings'));
        add_filter('the_content', array($this, 'ifWrap'));
    }

    function ifWrap($content)
    {
        if (is_main_query() && is_single() && (get_option('wcp_word_count', 1) || get_option('wcp_char_count', '1') || get_option('wcp_read_time', '1'))) {

            return $this->create_html($content);
        }

        return $content;
    }

    function create_html($content)
    {
        $html = '<h3>' . esc_html(get_option('wcp_headline', 'Post Statistics')) . '</h3><p>';

        // get word count once and put it into a variable.
        if (get_option('wcp_word_count', '1') || get_option('wcp_read_time', '1')) {
            $word_count = str_word_count(strip_tags($content));
        }

        if (get_option('wcp_word_count', '1')) {
            $html .= 'This post has ' . $word_count . ' words. <br>';
        }

        if (get_option('wcp_char_count', '1')) {
            $html .= 'This post has ' . strlen(strip_tags($content)) . ' characters. <br>';
        }

        if (get_option('wcp_read_time', '1')) {
            $html .= 'This post will take about ' . round($word_count / 225) . ' minute(s) to read. <br>';
        }

        $html .= '</p>';

        if (get_option('wcp_location', '0') == '0') {
            return $html . $content;
        }

        return $content . $html;
    }

    function settings()
    {
        add_settings_section('wcp_first_section', null, null, 'word-count-settings');

        // location
        add_settings_field('wcp_location', 'Display Location', array($this, 'location_html'), 'word-count-settings', 'wcp_first_section');
        register_setting('word_count_plugin', 'wcp_location', array(
            'sanitize_callback' => array($this, 'sanitize_location'),
            'default' => '0'
        ));

        // headline text
        add_settings_field('wcp_headline', 'Headline Text', array($this, 'headline_html'), 'word-count-settings', 'wcp_first_section');
        register_setting('word_count_plugin', 'wcp_headline', array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'Post Statistics'
        ));

        // word count option
        add_settings_field('wcp_word_count', 'Word Count', array($this, 'word_count_html'), 'word-count-settings', 'wcp_first_section');
        register_setting('word_count_plugin', 'wcp_word_count', array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => '1'
        ));

        // character count option
        add_settings_field('wcp_char_count', 'Word Count', array($this, 'char_count_html'), 'word-count-settings', 'wcp_first_section');
        register_setting('word_count_plugin', 'wcp_char_count', array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => '0'
        ));

        // read time option
        add_settings_field('wcp_read_time', 'Word Count', array($this, 'read_time_html'), 'word-count-settings', 'wcp_first_section');
        register_setting('word_count_plugin', 'wcp_read_time', array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => '0'
        ));
    }

    function sanitize_location($input)
    {
        if ($input != '0' && $input != '1') {
            add_settings_error('wcp_location', 'wcp_location_error', 'Display location must be either beginning or end');
            return get_option('wcp_location');
        }
        return $input;
    }

    function location_html()
    { ?>
        <select name="wcp_location">
            <option value="0" <?php selected(get_option('wcp_location'), "0") ?>>Beginning of Post</option>
            <option value="1" <?php selected(get_option('wcp_location'), "1") ?>>End of Post</option>
        </select>
    <?php
    }

    function headline_html()
    {
    ?>
        <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline')) ?>">

    <?php
    }

    function word_count_html()
    {
    ?>
        <input type="checkbox" name="wcp_word_count" value="1" <?php checked(get_option('wcp_word_count'), '1') ?>>

    <?php
    }

    function char_count_html()
    {
    ?>
        <input type="checkbox" name="wcp_char_count" value="1" <?php checked(get_option('wcp_char_count'), '1') ?>>

    <?php
    }

    function read_time_html()
    {
    ?>
        <input type="checkbox" name="wcp_read_time" value="1" <?php checked(get_option('wcp_read_time'), '1') ?>>

    <?php
    }

    function admin_page()
    {
        add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings', array($this, 'settings_html'));
    }

    function settings_html()
    {
    ?>

        <div class="wrap">
            <h1>Word Count Settings</h1>
            <form action="options.php" method="post">
                <?php
                settings_fields('word_count_plugin');

                do_settings_sections('word-count-settings');

                submit_button();
                ?>
            </form>
        </div>

<?php
    }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();
