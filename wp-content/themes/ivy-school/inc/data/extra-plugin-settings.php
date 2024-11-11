<?php

/**
 * Import settings
 */
function thim_import_extra_plugin_settings( $settings ) {
    // Learnpress
    $settings[] = 'learn_press_profile_picture_thumbnail_size';
    $settings[] = 'learn_press_profile_page_id';
    $settings[] = 'learn_press_checkout_page_id';
    // Revolution slider
    $settings[] = 'revslider-global-settings';
    // Permalink
    $settings[] = 'permalink_structure';
    // Site Origin
    $settings[] = 'panels_setting';
    //Easy Forms for MailChimp
    $settings[] = 'yikes_easy_mailchimp_extender_forms';
    $settings[] = 'yikes-mc-api-validation';

    return $settings;
}

add_filter( 'thim_importer_basic_settings', 'thim_import_extra_plugin_settings' );