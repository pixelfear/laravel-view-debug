<?php

namespace Tests;

use Illuminate\Support\Facades\View;
use Orchestra\Testbench\Attributes\DefineEnvironment;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BasicTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        View::addLocation(__DIR__.'/fixtures/views');
    }

    #[Test]
    #[DefineEnvironment('debugEnabled')]
    function it_adds_comments_when_debug_mode_is_enabled()
    {
        $dir = __DIR__.'/fixtures/views';

        $expected = <<<CONTENTS
<!-- Start view: $dir/view.blade.php -->Some view contents.

<!-- Start view: $dir/subview.blade.php -->Sub view contents.
<!-- End view: $dir/subview.blade.php -->
Some more view contents.
<!-- End view: $dir/view.blade.php -->
CONTENTS;

        $this->assertEquals($expected, view('view')->render());
    }

    #[Test]
    function it_doesnt_add_comments_when_debug_mode_is_disabled()
    {
        $expected = <<<CONTENTS
Some view contents.

Sub view contents.

Some more view contents.

CONTENTS;

        $this->assertEquals($expected, view('view')->render());
    }
}
