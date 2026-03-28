<?php
/**
 * bitski-wp-plugin-boilerplate
 *
 * Slim WordPress plugin boilerplate integrating PHP OOP principles.
 *
 * @since 0.1.0
 *
 * @wordpress-plugin
 * Plugin Name: bitski-wp-plugin-boilerplate
 * Plugin URI: https://github.com/bitski/bitski-wp-plugin-boilerplate
 * Author: Peter Eckerle
 * Author URI: https://bitski.de
 * Description: Slim WordPress plugin boilerplate integrating PHP OOP principles.
 * Version: 0.1.3
 * Requires at least: 6.6
 * Requires PHP: 7.4
 * License: GNU General Public License v3.0 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: bitski-wp-plugin-boilerplate
 * Domain Path: /languages
 */

// Loads the plugin init file.
if (file_exists(__DIR__ . '/init.php')) {
    require_once __DIR__ . '/init.php';
}
