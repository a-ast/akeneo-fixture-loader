<?php

namespace spec\Aa\AkeneoFixtureLoader\Expression;

use Aa\AkeneoFixtureLoader\Faker\FakerAdapter;
use PhpSpec\ObjectBehavior;

class ResolverSpec extends ObjectBehavior
{
    function it_resolves(FakerAdapter $faker)
    {
        $this->beConstructedWith($faker);

        $faker->fake('expression', [])->shouldBeCalled();

        $this->resolve('expression');
    }
}
