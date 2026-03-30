<?php

/** Centralized plugin configuration class.
 *
 * Serves as a centralized data provider for plugin constants, options and CSS classes.
 *
 * @since 0.1.3
 */

namespace BitskiWPPluginBoilerplate\plugin;

class Config
{
    /**
     * Plugin identity constants.
     *
     * Set at compile time.
     */
    public const string SLUG = 'bitski-wp-plugin-boilerplate';
    public const string VERSION = '0.1.3';

    /**
     * Plugin paths and URLs.
     *
     * Set via Config at runtime.
     */
    public static string $path = '';
    public static string $file = '';
    public static string $url = '';

    /**
     * Centralized array to manage plugin options.
     * Key: option name, Value: option value
     * Usage: apply_filters('option-name', 'default-value')
     */
    public static array $options = [
        // Example: 'option-name' => 'default-value'

        // Lifecycle options
        'bitski-wp-plugin-boilerplate/option/lifecycle/load' => true,

        // Add more option filters as needed
    ];

    /**
     * Centralized array to manage CSS classes for various plugin components.
     * Key: filter name, Value: array of default classes
     * Usage: apply_filters('filter-name', 'default-classes')
     */
    public static array $classes = [
        // Example: 'filter-name' => [ 'class1', 'class2' ]

        // Add more class name filters as needed
    ];

    /**
     * Intentionally left empty.
     * Config is a static data provider.
     */
    public function init(): void
    {
    }
}
