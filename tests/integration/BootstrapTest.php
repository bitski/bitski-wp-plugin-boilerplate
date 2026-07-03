<?php

declare(strict_types=1);

namespace BitskiWPPluginBoilerplate\Tests\integration;

use PHPUnit\Framework\TestCase;

class BootstrapTest extends TestCase
{
    public function testWordPressIsLoaded(): void
    {
        $this->assertTrue(
            function_exists('add_action'),
            'WordPress bootstrap failed: function add_action() not available.'
        );
    }
}
