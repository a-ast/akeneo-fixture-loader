<?php

namespace spec\Aa\AkeneoFixtureLoader\Fixture;

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

        $resolver->resolve('a0', '')->shouldBeCalled()->willReturn('x0');
        $resolver->resolve('a1', '')->shouldBeCalled()->willReturn('x1');
        $resolver->resolve('b0', '')->shouldBeCalled()->willReturn('y0');
        $resolver->resolve('c0', '')->shouldBeCalled()->willReturn('z0');
        $resolver->resolve('c1', '')->shouldBeCalled()->willReturn('z1');
        $resolver->resolve('c2', '')->shouldBeCalled()->willReturn('z2');

        $this->resolve($fixture)->shouldBeLike([
            'a' => [
                'x0', 'x1',
            ],
            'b' => [
                0 => 'y0',
                1 => ['z0', 'z1', 'z2'],
            ],
        ]);
    }
}
