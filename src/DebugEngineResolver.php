<?php

namespace Pixelfear\ViewDebug;

use Illuminate\View\Engines\EngineResolver;

class DebugEngineResolver extends EngineResolver
{
    protected $resolver;

    public function __construct(EngineResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function register($engine, $resolver)
    {
        return $this->resolver->register($engine, $resolver);
    }

    public function resolve($engine)
    {
        return new DebugEngine($this->resolver->resolve($engine));
    }
}
