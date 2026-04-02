<?php
/**
 * Plugin lifecycle class.
 *
 * Registers plugin lifecycle hooks (activation, deactivation, uninstall).
 *
 * @since 0.1.4
 */

namespace BitskiWPPluginBoilerplate\plugin;

class Lifecycle
{
    /**
     * Initializes lifecycle class.
     */
    public function init(): void
    {
        register_activation_hook(BITSKI_WP_PLUGIN_BOILERPLATE_FILE, [$this, 'activate']);
        register_deactivation_hook(BITSKI_WP_PLUGIN_BOILERPLATE_FILE, [$this, 'deactivate']);
        register_uninstall_hook(BITSKI_WP_PLUGIN_BOILERPLATE_FILE, [self::class, 'uninstall']); // Static callback required for this WordPress hook.
    }

    /**
     * Plugin activation logic.
     */
    public function activate(): void
    {
        error_log('Plugin activated');
    }

    /**
     * Plugin deactivation logic.
     */
    public function deactivate(): void
    {
        error_log('Plugin deactivated');
    }

    /**
     * Plugin uninstallation logic.
     * The callback of the uninstall hook must be static.
     */
    public static function uninstall(): void
    {
        error_log('Plugin uninstalled');
    }
}
