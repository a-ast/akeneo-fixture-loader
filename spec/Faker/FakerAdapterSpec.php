<?php

namespace spec\Aa\AkeneoFixtureLoader\Faker;

use Faker\Generator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FakerAdapterSpec extends ObjectBehavior
{
    function let(Generator $faker)
    {
        $this->beConstructedWith($faker);
    }

    function it_fakes()
    {
        $this->fake('expression', ['a', 'b']);
    }
}
