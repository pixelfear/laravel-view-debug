<?php

namespace Pixelfear\ViewDebug;

use Illuminate\Contracts\View\Engine;

class DebugEngine implements Engine
{
    protected $engine;

    public function __construct($engine)
    {
        $this->engine = $engine;
    }

    public function get($path, $data = [])
    {
        return vsprintf('<!-- Start view: %s -->%s<!-- End view: %s -->', [
            $path,
            $this->engine->get($path, $data),
            $path
        ]);
    }
}
