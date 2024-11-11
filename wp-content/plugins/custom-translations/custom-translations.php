<?php
/*
 * Plugin Name: Custom Translations Loader
 * Description: A custom plugin to load translations from wp-content/languages/custom.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access to the file.
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Load custom translations from wp-content/languages/custom.
 */
function load_custom_translations()
{
    $custom_path = WP_LANG_DIR . '/custom/';

    // Load translations for a specific text domain.
    load_textdomain('customtranslations', $custom_path . 'customtranslations-es.mo');

    // Add additional domains if needed.
    // load_textdomain( 'another-textdomain', $custom_path . 'another-file-es.mo' );
}
add_action('plugins_loaded', 'load_custom_translations');


/**
 * Enqueue custom CSS for the plugin.
 */
function custom_translations_enqueue_styles()
{
    // Register the stylesheet.
    wp_enqueue_style(
        'custom-translations-style', // Handle for the stylesheet.
        plugins_url( 'css/custom-style.css', __FILE__ ), // Path to the stylesheet.
        array(), // Dependencies (if any).
        '1.0.1', // Version of the stylesheet.
        'all' // Media type (all, print, screen, etc.).
    );
}
add_action('wp_enqueue_scripts', 'custom_translations_enqueue_styles');
