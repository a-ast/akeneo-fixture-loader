<?php

namespace spec\Aa\AkeneoFixtureLoader\Parser\Node;

use PhpSpec\ObjectBehavior;

class LoopSpec extends ObjectBehavior
{
    function it_returns_all_loop_properties()
    {
        $this->beConstructedThrough('create', ['milky-way', 1, 10]);

        $this->getName()->shouldReturn('milky-way');
        $this->getStartIndex()->shouldReturn(1);
        $this->getStopIndex()->shouldReturn(10);
    }
}
