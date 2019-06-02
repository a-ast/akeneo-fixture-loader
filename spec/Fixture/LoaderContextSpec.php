<?php

namespace spec\Aa\AkeneoFixtureLoader\Fixture;

use Aa\AkeneoFixtureLoader\Fixture\LoaderContext;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LoaderContextSpec extends ObjectBehavior
{
    function it_can_be_created()
    {
        $this->beConstructedThrough('create', ['index']);

        $this->getCurrentIndex()->shouldReturn('index');
    }
}
