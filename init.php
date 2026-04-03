<?php

// Exits if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Plugin bootstrap and class initialization.
 *
 * Loads the Composer autoloader if available.
 * Instantiates and initializes all core and feature classes.
 * Conditionally instantiates and initializes classes based on plugin options.
 * Logs autoloader and class instantiation errors without breaking the plugin.
 *
 * @since 0.1.0
 */
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    error_log('Autoloader not found: ' . __DIR__ . '/vendor/autoload.php');
}

/**
 * Array of core and feature plugin classes to be initialized automatically, can be extended or modified as needed.
 *
 * Core and feature classes that are initialized unconditionally.
 *
 * @var array $bootstrap_classes
 */
$bootstrap_classes = [
    \BitskiWPPluginBoilerplate\plugin\Config::class,
    \BitskiWPPluginBoilerplate\plugin\Options::class,
    \BitskiWPPluginBoilerplate\plugin\Setup::class,
    \BitskiWPPluginBoilerplate\plugin\Hooks::class,
];

/**
 * Array of conditional classes that are only initialized if the corresponding plugin option is enabled.
 *
 * Each entry maps a filter name to the class that should be instantiated.
 * Filter keys enable/disable optional plugin features via plugin options.
 *
 * @var array $conditional_class_map
 */
$conditional_class_map = [
    'bitski-wp-plugin-boilerplate/option/lifecycle/load' => \BitskiWPPluginBoilerplate\plugin\Lifecycle::class,
];

/**
 * Instantiates and initializes core and feature classes unconditionally.
 */
foreach ($bootstrap_classes as $class) {
    try {
        $instance = new $class();
        if (method_exists($instance, 'init')) {
            $instance->init();
        }
    } catch (\Throwable $error) {
        error_log($class . ' Error: ' . $error->getMessage());
    }
}

/**
 * Instantiates and initializes conditional classes based on plugin option filters.
 */
foreach ($conditional_class_map as $filter => $class) {
    if (apply_filters($filter, null)) {
        try {
            $instance = new $class();
            if (method_exists($instance, 'init')) {
                $instance->init();
            }
        } catch (\Throwable $error) {
            error_log($class . ' Error: ' . $error->getMessage());
        }
    }
}
