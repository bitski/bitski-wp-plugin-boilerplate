<?php
/**
 * Plugin setup class.
 *
 * @since 0.1.3
 */

namespace BitskiWPPluginBoilerplate\plugin;

class Setup
{
    /**
     * Initializes plugin setup
     *
     * Plugin textdomain loading and future setup actions.
     * Additional setup actions/features progressively enhanced here.
     */
    public function init(): void
    {
        add_action('plugins_loaded', [$this, 'setConfigVariables'], 5);
        add_action('plugins_loaded', [$this, 'loadTextdomain'], 10);
    }

    /**
     * Sets plugin static configuration variables at runtime.
     */
    public function setConfigVariables(): void
    {
        Config::$path = dirname(__FILE__, 3);
        Config::$file = Config::$path.'/bitski-wp-plugin-boilerplate.php';
        Config::$url  = plugins_url('', Config::$file);
    }

    /**
     * Loads plugin textdomain for translations.
     */
    public function loadTextdomain(): void
    {
        load_plugin_textdomain(Config::SLUG, false, Config::$path.'/languages');
    }
}
