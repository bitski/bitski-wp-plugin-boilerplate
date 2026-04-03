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
        $this->registerBaseHooks();         // Base hooks, e.g.: image sizes.
        $this->registerFunctionalHooks();   // Functional hooks, e.g., JS events, archive query, footer actions.
    }

    /**
     * Registers base hooks.
     */
    protected function registerBaseHooks(): void
    {
    }

    /**
     * Registers functional hooks.
     */
    protected function registerFunctionalHooks(): void
    {
        // Archive hooks.
        // (To be inhabited)

        // Header hooks.
        // (To be inhabited)

        // Page hooks.
        // (To be inhabited)

        // Footer hooks.
        // (To be inhabited)
    }
}
