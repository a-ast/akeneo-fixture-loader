<?php

namespace spec\Aa\AkeneoFixtureLoader\Expression;

use Aa\AkeneoFixtureLoader\Expression\ResolverRegistry;
use Aa\AkeneoFixtureLoader\Fixture\LoaderContext;
use PhpSpec\ObjectBehavior;

class LocalizedResolverSpec extends ObjectBehavior
{
    function it_resolves(ResolverRegistry $registry)
    {
        $this->beConstructedWith($registry);

        $registry->get('locale')->shouldBeCalled();

        $this->resolve('expression', 'locale', LoaderContext::create('1'));
    }
}
