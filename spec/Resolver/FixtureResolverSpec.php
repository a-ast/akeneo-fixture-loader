<?php

namespace spec\Aa\AkeneoFixtureLoader\Resolver;

use Aa\AkeneoFixtureLoader\Expression\LocalizedResolver;
use PhpSpec\ObjectBehavior;

class FixtureResolverSpec extends ObjectBehavior
{
    function let(LocalizedResolver $resolver)
    {
        $this->beConstructedWith($resolver);
    }

    function it_resolves_all_values_in_a_fixture(LocalizedResolver $resolver)
    {
        $fixture = [
            'a' => [
                'a0', 'a1',
            ],
            'b' => [
                0 => 'b0',
                1 => ['c0', 'c1', 'c2'],
            ],
        ];

        $resolver->resolve('a0', '')->shouldBeCalled();
        $resolver->resolve('a1', '')->shouldBeCalled();
        $resolver->resolve('b0', '')->shouldBeCalled();
        $resolver->resolve('c0', '')->shouldBeCalled();
        $resolver->resolve('c1', '')->shouldBeCalled();
        $resolver->resolve('c2', '')->shouldBeCalled();

        $this->resolve($fixture);
    }
}
