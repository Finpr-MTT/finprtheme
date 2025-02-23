<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/fin-elementor-theme/
 *
 * @package finprtheme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define constants for theme paths.
define('FINPRTHEME_VERSION', '1.0.1');
define('FINPRTHEME_DIR', get_stylesheet_directory() . '/');
define('FINPRTHEME_URL', get_stylesheet_directory() . '/');

/**
 * Initialize the plugin.
 */
class Finprtheme_Checkout {
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'finprtheme_scripts_styles'], 20);
    }

    function finprtheme_scripts_styles()
    {
        wp_enqueue_style('finprtheme-style', get_stylesheet_directory_uri() . '/style.css', [], FINPRTHEME_VERSION);
        wp_enqueue_style('finpr-theme-style', get_stylesheet_directory_uri() . '/assets/css/finprtheme.css', [], FINPRTHEME_VERSION);
        wp_enqueue_script('finpr-theme-script', get_stylesheet_directory_uri() . '/assets/js/finprtheme.js', [], FINPRTHEME_VERSION, true);
    }
}
new Finprtheme_Checkout();