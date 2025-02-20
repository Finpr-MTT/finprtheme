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
        // Include necessary files.
        $this->finprtheme_includes();
        $this->finprtheme_init();
        add_action('wp', [$this, 'finprtheme_split_order_review_checkout']);
        add_action('wp_enqueue_scripts', [$this, 'finprtheme_scripts_styles'], 20);        
        add_action('woocommerce_checkout_before_order_review', 'woocommerce_order_review', 10);
        add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
    }

    private function finprtheme_includes() {
        //require_once FINPRTHEME_DIR . 'inc/public/class-finprtheme-helper.php';
        //require_once FINPRTHEME_DIR . 'inc/public/class-finprtheme-product-cart.php';
    }

    private function finprtheme_init() {
        new Finprtheme_Helper();
        //new Finprtheme_Product_Cart();
    }

    public function finprtheme_split_order_review_checkout() {
        remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
        remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10);
    }

    function finprtheme_scripts_styles()
    {
        wp_enqueue_style('fin-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css', [], '5.3.0-alpha3');
        wp_enqueue_style('finprtheme-style', get_stylesheet_directory_uri() . '/style.css', [], FINPRTHEME_VERSION);
        wp_enqueue_style('finpr-theme-style', get_stylesheet_directory_uri() . '/assets/css/finprtheme.css', [], FINPRTHEME_VERSION);
        wp_enqueue_script('finpr-bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js', ['jquery'], '5.3.0-alpha3', true);
        wp_enqueue_script('finpr-theme-script', get_stylesheet_directory_uri() . '/assets/js/finprtheme.js', [], FINPRTHEME_VERSION, true);
    }
}
new Finprtheme_Checkout();