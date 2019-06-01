<?php

namespace spec\Aa\AkeneoFixtureLoader\Expression;

use Aa\AkeneoFixtureLoader\Expression\Resolver;
use PhpSpec\ObjectBehavior;

class ResolverRegistrySpec extends ObjectBehavior
{
    function it_provides_faker()
    {
        $this->get('locale1')->shouldHaveType(Resolver::class);
    }
}
