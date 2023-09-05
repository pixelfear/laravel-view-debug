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

    /** @test */
    public function it_throw_bad_method_call_exception()
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Call to undefined method Pixelfear\\ViewDebug\\DebugEngine::foo()');

        $mock = Mockery::mock(Engine::class);
        $mock->shouldReceive('foo')->with('bar')->andThrow(
            BadMethodCallException::class,
            'Call to undefined method '.get_class($mock).'::foo()'
        );

        $engine = new DebugEngine($mock);

        $engine->foo('bar');
    }
}
