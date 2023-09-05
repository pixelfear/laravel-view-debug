<?php

namespace Tests;

use Illuminate\Contracts\View\Engine;
use Mockery;
use Pixelfear\ViewDebug\DebugEngine;

class DebugEngineTest extends TestCase
{
    /** @test */
    public function it_forwards_calls_to_engine()
    {
        $engine = Mockery::mock(Engine::class);
        $engine->shouldReceive('foo')->with('bar')->andReturn('baz');

        $debug = new DebugEngine($engine);

        $this->assertEquals('baz', $debug->foo('bar'));
    }

    /** @test */
    public function it_forwards_calls_to_engine_and_allows_fluency()
    {
        $engine = Mockery::mock(Engine::class);
        $engine->shouldReceive('foo')->with('bar')->andReturnSelf();

        $debug = new DebugEngine($engine);

        $this->assertSame($debug, $debug->foo('bar'));
    }
}
