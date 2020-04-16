<?php

namespace Tests;

use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Pixelfear\ViewDebug\ViewDebugServiceProvider;

class TestCase extends TestbenchTestCase
{
    protected function getPackageProviders($app)
    {
        return [ViewDebugServiceProvider::class];
    }

    protected function debugEnabled($app)
    {
        $app['config']->set('app.debug', true);
    }
}
