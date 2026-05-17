<?php
/**
 * Plugin assets loader.
 *
 * @since 0.6.0
 */

namespace BitskiWPPluginBoilerplate\assets;

class AssetsLoader
{
    /**
     * Initializes assets loader.
     */
    public function init(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueFrontendAssets']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdminAssets']);
        add_action('enqueue_block_editor_assets', [$this, 'enqueueBlockEditorAssets']);
    }

    /**
     * Enqueues plugin frontend assets.
     */
    public function enqueueFrontendAssets(): void
    {
        $pluginVersion = BITSKI_WP_PLUGIN_BOILERPLATE_VERSION;
        $pluginUri     = BITSKI_WP_PLUGIN_BOILERPLATE_URL;
        $pluginDir     = BITSKI_WP_PLUGIN_BOILERPLATE_PATH;

        // Determines main JS file, prefers minified version if available.
        $pluginMainScript = file_exists($pluginDir . '/assets/js/main.min.js') ? 'main.min.js' : 'main.js';

        // CSS
        //
        // Main plugin CSS
        wp_enqueue_style(
            'bitski-wp-plugin-boilerplate-frontend-style',
            $pluginUri . '/assets/css/main.min.css',
            [],
            $pluginVersion
        );

        // Scripts
        //
        // Main plugin JS (ESM module)
        // Requires WordPress 6.5 or higher for native wp_enqueue_script_module() support.
        wp_enqueue_script_module(
            'bitski-wp-plugin-boilerplate-frontend-script',
            $pluginUri . '/assets/js/' . $pluginMainScript,
            [],
            $pluginVersion,
            [
                'in_footer' => true,
            ]
        );
    }

    /**
     * Enqueues plugin admin assets.
     */
    public function enqueueAdminAssets(): void
    {
        $pluginVersion = BITSKI_WP_PLUGIN_BOILERPLATE_VERSION;
        $pluginUri     = BITSKI_WP_PLUGIN_BOILERPLATE_URL;

        // CSS
        //
        // Main plugin admin CSS
        wp_enqueue_style(
            'bitski-wp-plugin-boilerplate-admin-style',
            $pluginUri . '/assets/css/admin.min.css',
            [],
            $pluginVersion
        );
    }

    /**
     * Enqueues plugin block editor assets.
     *
     * @since 0.10.1
     */
    public function enqueueBlockEditorAssets(): void
    {
        $pluginVersion = BITSKI_WP_PLUGIN_BOILERPLATE_VERSION;
        $pluginUri     = BITSKI_WP_PLUGIN_BOILERPLATE_URL;

        // CSS
        //
        // Block editor style
        wp_enqueue_style(
            'bitski-wp-plugin-boilerplate-block-editor-style',
            $pluginUri . '/assets/css/editor.css',
            [],
            $pluginVersion
        );
    }
}
