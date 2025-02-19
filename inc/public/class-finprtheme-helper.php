<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Finprtheme_Helper
 */
class Finprtheme_Helper {

    /**
     * Constructor: Register hooks and filters.
     */
    public function __construct() {
        add_action('template_redirect', [$this, 'finprtheme_restrict_frontend_website_access']);
    }

    public function finprtheme_restrict_frontend_website_access() {
        if (is_admin()) {
            return; // Allow wp-admin access
        }

        // Get the current request URI
        $request_uri = $_SERVER['REQUEST_URI'];

        // Allow WooCommerce API requests
        if (strpos($request_uri, '/wp-json/wc/v3/') === 0) {
            return;
        }

        // Allow REST API authentication requests (optional)
        if (strpos($request_uri, '/wp-json/') === 0 && isset($_SERVER['HTTP_AUTHORIZATION'])) {
            return;
        }

        // Allow admin-ajax.php for WooCommerce & WP functions
        if (strpos($request_uri, '/wp-admin/admin-ajax.php') === 0) {
            return;
        }

        // Check if the user is logged in and is an admin
        if (is_user_logged_in() && current_user_can('administrator')) {
            return; // Allow admins to access all pages
        }

        // Block all other requests and return JSON response
        header('Content-Type: application/json');
        http_response_code(403);
        echo json_encode([
            'status' => 403,
            'error' => 'Access Denied',
            'message' => 'You do not have permission to access this resource.'
        ]);
        exit;
    }


}