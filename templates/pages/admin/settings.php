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
        do_settings_sections(BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '-settings');
        ?>
        <table class="form-table" role="presentation">
            <tbody>
            <!-- Option 1: Plugin enabled (static) -->
            <tr>
                <th scope="row">
                    <label for="admin_option_enabled">Enable plugin</label>
                </th>
                <td>
                    <input type="checkbox" id="admin_option_enabled"
                            <?php
                            checked(Options::get('bitski-wp-plugin-boilerplate/option/admin/enabled'), true); ?>
                           disabled/>
                    <p class="description">This checkbox shows whether the plugin is enabled (static display).</p>
                </td>
            </tr>

            <!-- Option 2: Submit button label (static) -->
            <tr>
                <th scope="row">
                    <label for="admin_option_submit_button_label">Submit button label</label>
                </th>
                <td>
                    <input type="text" id="admin_option_submit_button_label"
                           value="<?php
                           echo esc_attr(
                                   Options::get('bitski-wp-plugin-boilerplate/option/admin/submit-button-label')
                           ); ?>"
                           class="regular-text" readonly/>
                    <p class="description">This shows the submit button label (static display).</p>
                </td>
            </tr>
            </tbody>
        </table>
        <?php
        $submit_button_label = Options::get('bitski-wp-plugin-boilerplate/option/admin/submit-button-label');
        submit_button($submit_button_label); ?>
    </form>
</div>
