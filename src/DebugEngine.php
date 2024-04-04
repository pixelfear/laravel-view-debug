<?php

namespace Pixelfear\ViewDebug;

use Illuminate\Contracts\View\Engine;
use Illuminate\Support\Traits\ForwardsCalls;

class DebugEngine implements Engine
{
    use ForwardsCalls;

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

    public function __call($method, $parameters)
    {
        return $this->forwardDecoratedCallTo($this->engine, $method, $parameters);
    }
}
