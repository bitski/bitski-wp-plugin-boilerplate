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
     * Plugin options, defines the default values.
     *
     * @since 0.2.3
     */
    private array $options = [
            'admin_option_enable_plugin'       => 0,
            'admin_option_h1_color'            => '#0073aa',
            'admin_option_submit_button_label' => 'Submit',
    ];

    /**
     * Initializes plugin admin interface.
     */
    public function init(): void
    {
        add_action('admin_menu', [$this, 'addSettingsPage']);
        add_action('admin_init', [$this, 'registerSettings']);

        $savedOptions = get_option(BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '_options', []);
        $savedOptions = is_array($savedOptions) ? $savedOptions : [];

        $this->options = array_replace($this->options, $savedOptions);
    }

    /**
     * Getter for the option if the plugin is enabled.
     *
     * @since 0.2.3
     */
    private function isPluginEnabled(): bool
    {
        return ! empty($this->options['admin_option_enable_plugin']);
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
                BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '_options',
                [
                        'type'              => 'array',
                        'sanitize_callback' => [$this, 'sanitizeOptions'],
                ]
        );

        add_settings_section(
                'admin_settings_section',
                'Admin Settings',
                '__return_null',
                BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '-settings'
        );

        add_settings_field(
                'admin_option_enable_plugin',
                'Enable plugin',
                [$this, 'renderEnablePluginField'],
                BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '-settings',
                'admin_settings_section'
        );

        add_settings_field(
                'admin_option_h1_color',
                'H1 color',
                [$this, 'renderH1ColorField'],
                BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '-settings',
                'admin_settings_section'
        );

        add_settings_field(
                'admin_option_submit_button_label',
                'Submit button label',
                [$this, 'renderSubmitButtonLabelField'],
                BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '-settings',
                'admin_settings_section'
        );
    }

    /**
     * Sanitizes the plugin options.
     */
    public function sanitizeOptions($input): array
    {
        $input = is_array($input) ? $input : [];

        return [
                'admin_option_enable_plugin'       => ! empty($input['admin_option_enable_plugin']) ? 1 : 0,
                'admin_option_h1_color'            => sanitize_hex_color(
                        $input['admin_option_h1_color'] ?? ''
                ) ?: '#0073aa',
                'admin_option_submit_button_label' => sanitize_text_field(
                        $input['admin_option_submit_button_label'] ?? 'Submit'
                ),
        ];
    }

    /**
     * Renders the "Enable plugin" checkbox field.
     */
    public function renderEnablePluginField(): void
    { ?>
        <label for="<?php
        echo BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '_options[admin_option_enable_plugin]'; ?>">Enable plugin</label>
        <input type="checkbox"
               name="<?php
               echo BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '_options[admin_option_enable_plugin]'; ?>"
               value="1" <?php
        checked($this->options['admin_option_enable_plugin']); ?> />
        <span class="description">Enable or disable the plugin.</span>

        <?php
    }

    /**
     * Renders the "H1 color" color picker field.
     *
     * @since 0.2.3
     */
    public function renderH1ColorField(): void
    { ?>
        <label for="<?php
        echo BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '_options[admin_option_h1_color]'; ?>">H1 color</label>
        <input type="color"
               name="<?php
               echo BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '_options[admin_option_h1_color]'; ?>"
               value="<?php
               echo esc_attr($this->options['admin_option_h1_color']); ?>"
        />
        <?php
    }

    /**
     * Renders the "Submit button label" text field.
     */
    public function renderSubmitButtonLabelField(): void
    { ?>
        <label for="<?php
        echo BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '_options[admin_option_submit_button_label]'; ?>">Submit button
            label</label>
        <input type="text"
               name="<?php
               echo BITSKI_WP_PLUGIN_BOILERPLATE_SLUG . '_options[admin_option_submit_button_label]'; ?>"
               value="<?php
               echo esc_attr($this->options['admin_option_submit_button_label']); ?>"
               class="regular-text"
                <?php
                echo ! $this->isPluginEnabled() ? ' disabled' : ''; ?>
        />
        <span class="description">Set the submit button label.</span>
        <?php
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
