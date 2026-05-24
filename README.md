# bitski-wp-plugin-boilerplate

[![Version](https://img.shields.io/github/v/release/bitski/bitski-wp-plugin-boilerplate?sort=semver)](https://github.com/bitski/bitski-wp-plugin-boilerplate/releases)
[![License](https://img.shields.io/github/license/bitski/bitski-wp-plugin-boilerplate)](LICENSE)
[![WordPress](https://img.shields.io/badge/WordPress-6.5%2B-blue)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/PHP-8.1%2B-red)](https://www.php.net)

Slim WordPress plugin boilerplate integrating PHP OOP principles and modular architecture for high-performance
development.

v1.0.0 | GPL v3+

## Disclaimer

This boilerplate is provided "as is", without warranty of any kind, either expressed or implied. The author is not
liable for any damages arising from its use. Use at your own risk.

## ✨ Features

- PHP OOP (PSR-4) + Composer autoload (`src/`): clear separation of Core, Admin, REST, Assets, and Templates.
- Modular Core Architecture: Lifecycle, Hooks, Setup, Config, Options – fully extendable.
- Admin & Settings Ready: minimal UI, Settings API, logic separated from presentation.
- REST API Layer: easy endpoint integration + standardized JSON responses.
- Assets Loader: conditional enqueue for Admin & Frontend.
- Template-ready (`templates/`): clean separation of PHP logic and templates.

## 🚀 Quick start

### Clone and install

```bash
cd wp-content/plugins
git clone https://github.com/bitski/bitski-wp-plugin-boilerplate.git
cd bitski-wp-plugin-boilerplate
composer install  # PSR-4 autoloader (autoloads src/ as BitskiWPPluginBoilerplate\)
```

### Activate

WordPress → Plugins → Activate

### Quality checks

vendor/bin/phpcs

## 📋 Requirements

### Server

- PHP 8.1+ (tested up to PHP 8.4)
- WordPress 6.5+
- MySQL 5.7+ / MariaDB 10.4+

### Development

- Composer 2.7+
- PHPCS 3.8+ (phpcs.xml inklusive, PSR-12)

## 📁 Structure

### Entry points

PHP: `src/` (PSR-4 namespace: BitskiWPPluginBoilerplate\*) → `src/core/` (Initialization order: Config → Options → Setup → Lifecycle → Hooks)

Bootstrap: bitski-wp-plugin-boilerplate.php → bootstrap.php

### Directory structure

```
├── src/                  # PHP PSR-4 Namespace: BitskiWPPluginBoilerplate\* (subfolders = sub-namespaces)
│   ├── admin/            # Admin pages, settings, notices
│   ├── assets/           # Assets loader: Enqueues, conditional loading
│   ├── core/             # Core plugin classes – Initialization order: Config → Options → Setup → Lifecycle → Hooks
│   ├── integration/      # Third-party integrations / adapters
│   └── rest/             # REST API endpoints
├── templates/            # Admin / frontend template partials
├── composer.json         # Composer + PSR-4 autoload configuration
├── bootstrap.php         # Internal plugin bootstrap
└── bitski-wp-plugin-boilerplate.php # WordPress plugin entry point
```

## 👤 Author

Peter Eckerle (bitski.de)  
[Website](https://bitski.de) | [GitHub](https://github.com/bitski)
