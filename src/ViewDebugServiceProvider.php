<?php

namespace Pixelfear\ViewDebug;

use Illuminate\Support\ServiceProvider;

class ViewDebugServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (config('app.debug')) {
            $this->app->extend('view.engine.resolver', function ($resolver) {
                return new DebugEngineResolver($resolver);
            });
        }
    }
}
