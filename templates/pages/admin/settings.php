<?php
/**
 * Page template for the plugin admin settings page.
 *
 * Displays the settings form for the plugin using the WordPress Settings API.
 * Loaded via the Admin class.
 *
 * @since 0.2.1
 */

use BitskiWPPluginBoilerplate\plugin\Options;

// Exits if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap">
    <h1>
        <?php
        echo esc_html(BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . ' Settings'); ?>
    </h1>

    <form action="options.php" method="post">
        <?php
        // WordPress Settings API, handles nonce, validation, and saving of settings.
        settings_fields(BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '_options_group');

        // Displays the registered settings fields for this page by calling their render methods from the Admin class. ?>
        <div class="field bitski-wp-plugin-boilerplate-enable-plugin">
            <?php $this->renderEnablePluginField(); ?>
        </div>
        <div class="field bitski-wp-plugin-boilerplate-submit-button-label">
            <?php $this->renderSubmitButtonLabelField(); ?>
        </div>

        <?php
        // Displays a submit button.
        $options             = get_option(BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '_options', []);
        $submit_button_label = $options['admin_option_submit_button_label'] ?? 'Submit';
        submit_button(esc_html($submit_button_label)); ?>
    </form>
</div>
