<?php
/**
 * Plugin admin interface.
 *
 * Handles plugin admin screens and options.
 *
 * @since 0.2.0
 */

namespace BitskiWPPluginBoilerplate\plugin;

class Admin
{
    /**
     * Initializes plugin admin interface.
     */
    public function init(): void
    {
        add_action('admin_menu', [$this, 'addSettingsPage']);
        add_action('admin_init', [$this, 'registerSettings']);
    }

    /**
     * Adds a plugin settings page as a submenu item to the Settings menu.
     */
    public function addSettingsPage(): void
    {
        add_submenu_page(
            'options-general.php',
            BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . ' Settings',
            BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . ' Settings',
            'manage_options',
            BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '-settings',
            [$this, 'displaySettingsPage']
        );
    }

    /**
     * Registers the plugin settings.
     *
     * Uses the WordPress Settings API to register a settings group and its associated options.
     * The settings group is named after the plugin slug with '_options_group' appended.
     * The options are named after the plugin slug with '_options' appended.
     * The options are stored together in a single database entry in the 'wp_options' table,
     * using the plugin slug with '_options' appended as the option name.
     *
     * @since 0.2.2
     */
    public function registerSettings(): void
    {
        register_setting(
            BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '_options_group',
            BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '_options'
        );
    }

    /**
     * Displays the plugin settings page.
     */
    public function displaySettingsPage(): void
    {
        // Check user capabilities.
        if ( ! current_user_can('manage_options')) {
            return;
        }

        // Displays the settings page.
        include_once BITSKI_WP_PLUGIN_BOILERPLATE_PATH . 'templates/pages/admin/settings.php';
    }
}
