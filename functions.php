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
 * Theme functionality: Features
 */
require_once THEME_DIR . '/inc/core/theme-features.php';

/**
 * Theme functionality: Nav menu locations
 */
require_once THEME_DIR . '/inc/core/nav-menu.php';

/**
 * Theme functionality: Image support
 */
require_once THEME_DIR . '/inc/core/image-support.php';

/**
 * Theme functionality: Page banner utility
 */
require_once THEME_DIR . '/inc/core/page-banner.php';

/**
 * Theme functionality: Post types
 */
require_once THEME_DIR . '/inc/types/post-types.php';

/**
 * Theme functionality: Adjust queries as needed
 */
require_once THEME_DIR . '/inc/campus/queries.php';
require_once THEME_DIR . '/inc/event/queries.php';
require_once THEME_DIR . '/inc/program/queries.php';

/**
 * Add scripts
 */
require_once THEME_DIR . '/inc/core/theme-scripts.php';

/**
 * Theme functionality: Set up Google map key
 */
require_once THEME_DIR . '/inc/campus/map-key.php';
