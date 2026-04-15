<?php
/**
 * Page template for the plugin admin settings page.
 *
 * Displays the settings form for the plugin using the WordPress Settings API.
 * Loaded via the Admin class.
 *
 * @since 0.2.1
 */

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
        do_settings_sections(BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '-settings');
        submit_button();
        ?>
    </form>
</div>