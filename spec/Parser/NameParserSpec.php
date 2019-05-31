<?php

namespace spec\Aa\AkeneoFixtureLoader\Parser;

use Aa\AkeneoFixtureLoader\Parser\Node\Loop;
use PhpSpec\ObjectBehavior;

class NameParserSpec extends ObjectBehavior
{
    function it_returns_a_loop_object()
    {
        $loop = Loop::create('apple', 1, 10);

        $this->parse('apple_{1..10}')->shouldBeLike($loop);
    }

    function it_returns_null_if_no_matches()
    {
        $this->parse('apple')->shouldReturn(null);
    }
}
