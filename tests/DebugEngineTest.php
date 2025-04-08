<?php

namespace Tests;

use BadMethodCallException;
use Illuminate\Contracts\View\Engine;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Pixelfear\ViewDebug\DebugEngine;

class DebugEngineTest extends TestCase
{
    #[Test]
    public function it_forwards_calls_to_engine()
    {
        $mock = Mockery::mock(Engine::class);
        $mock->shouldReceive('foo')->with('bar')->andReturn('baz');

        $engine = new DebugEngine($mock);

        $this->assertEquals('baz', $engine->foo('bar'));
    }

    #[Test]
    public function it_forwards_calls_to_engine_and_allows_fluency()
    {
        $mock = Mockery::mock(Engine::class);
        $mock->shouldReceive('foo')->with('bar')->andReturnSelf();

        $engine = new DebugEngine($mock);

        $this->assertSame($engine, $engine->foo('bar'));
    }

    #[Test]
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
