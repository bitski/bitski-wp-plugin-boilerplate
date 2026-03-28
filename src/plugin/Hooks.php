<?php
/**
 * Plugin hooks manager.
 *
 * @since 0.1.3
 */

namespace BitskiWPPluginBoilerplate\plugin;

class Hooks
{
    /**
     * Initializes plugin hooks.
     * Registers all hooks.
     */
    public function init(): void
    {
        $this->registerBaseHooks();         // Base hooks, support.
        $this->registerCssClassesHooks();   // CSS classes hooks.
        $this->registerOptionHooks();       // Plugin options hooks.
        $this->registerFunctionalHooks();   // Functional hooks, e.g., JS events.
    }

    /**
     * Registers base hooks.
     */
    protected function registerBaseHooks(): void
    {
    }

    /**
     * Registers hooks for CSS classes.
     */
    protected function registerCssClassesHooks(): void
    {
        foreach (Config::$classes as $filter => $setupClasses) {
            add_filter($filter, function ($defaultClasses = '', $merge = true) use ($filter) {
                // Returns classes as a space-separated string.
                return $this->getClassesByFilter($filter, $defaultClasses, $merge);
            }, 10, 2);
        }
    }

    /**
     * Getter for CSS classes by filter name.
     * Returns a space-separated string of classes.
     * Merges setup classes with default classes if $merge is true.
     * Otherwise, returns default classes only.
     *
     * @param  string  $filter
     * @param  array  $defaultClasses
     * @param  bool  $merge
     *
     * @return string
     */
    public function getClassesByFilter(string $filter, array $defaultClasses = [], bool $merge = true): string
    {
        // Get setup classes if they're set and not empty.
        $setupClasses = [];
        if (isset(Config::$classes[$filter]) && ! empty(Config::$classes[$filter])) {
            $setupClasses = Config::$classes[$filter];
        }

        // Ensure $defaultClasses is an array.
        if ( ! is_array($defaultClasses)) {
            $defaultClasses = [];
        }

        // If the $merge parameter is set to true, merge setup classes with default classes.
        // Returns merged classes as a space-separated string.
        if ($merge) {
            $merged_classes = array_filter(array_unique(array_merge($setupClasses, $defaultClasses)));

            return implode(' ', $merged_classes);
        }

        // Returns default classes only as a space-separated string.
        return implode(' ', $defaultClasses);
    }

    /**
     * Registers hooks for plugin options.
     */
    protected function registerOptionHooks(): void
    {
        foreach (Config::$options as $filter => $setupOption) {
            add_filter($filter, function ($defaultOption = null) use ($filter) {
                // Returns the option value or the default option if set.
                return $this->getOptionByFilter($filter, $defaultOption);
            });
        }
    }

    /**
     * Getter for plugin options by filter name.
     * Returns the default option if it is explicitly set (not null) and valid.
     * Otherwise, checks global Config options.
     *
     * @param  string  $filter
     * @param  mixed  $defaultOption  (default: null, for a fallback to global setup option)
     *
     * @return mixed
     */
    public function getOptionByFilter(string $filter, mixed $defaultOption = null): mixed
    {
        // Returns a default option if it is explicitly set (not null).
        // Returns a default option if it is boolean or integer,
        // or if it is set and neither an empty string nor an empty array.
        if ($defaultOption !== null) {
            if (is_bool($defaultOption)
                || is_int($defaultOption)
                || ($defaultOption !== ''
                    && ! (is_array($defaultOption) && empty($defaultOption)))) {
                return $defaultOption;
            }
        }

        // Returns a setup option if it's set and not empty.
        if (isset(Config::$options[$filter]) && Config::$options[$filter] !== '') {
            $setupOption = Config::$options[$filter];

            if (is_array($setupOption) || is_bool($setupOption)) {
                return $setupOption;
            }

            return (string)$setupOption;
        }

        // Returns a default option as a fallback.
        return $defaultOption;
    }

    /**
     * Registers hooks for functionalities.
     */
    protected function registerFunctionalHooks(): void
    {
        // Archive hooks.

        // Header hooks.
        // (To be inhabited)

        // Page hooks.
        // (To be inhabited)

        // Footer hooks.
    }
}
