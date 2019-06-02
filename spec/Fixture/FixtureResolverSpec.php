<?php

namespace spec\Aa\AkeneoFixtureLoader\Fixture;

use Aa\AkeneoFixtureLoader\Expression\LocalizedResolver;
use Aa\AkeneoFixtureLoader\Fixture\LoaderContext;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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
                'a0',
                'a1',
            ],
            'b' => [
                0 => 'b0',
                1 => ['c0', 'c1', 'c2'],
            ],
        ];

        $context = LoaderContext::create('1');

        $resolver->resolve('a0', 'en_GB', $context)->shouldBeCalled()->willReturn('x0');
        $resolver->resolve('a1', 'en_GB', $context)->shouldBeCalled()->willReturn('x1');
        $resolver->resolve('b0', 'en_GB', $context)->shouldBeCalled()->willReturn('y0');
        $resolver->resolve('c0', 'en_GB', $context)->shouldBeCalled()->willReturn('z0');
        $resolver->resolve('c1', 'en_GB', $context)->shouldBeCalled()->willReturn('z1');
        $resolver->resolve('c2', 'en_GB', $context)->shouldBeCalled()->willReturn('z2');

        $this
            ->resolve($fixture, 'en_GB', $context)
            ->shouldBeLike(
            [
                'a' => [
                    'x0',
                    'x1',
                ],
                'b' => [
                    0 => 'y0',
                    1 => ['z0', 'z1', 'z2'],
                ],
            ]
        );
    }

    function it_does_not_resolve_null_values(LocalizedResolver $resolver)
    {
        $fixture = [
            'a' => null,
        ];

        $resolver->resolve(Argument::type('string'), Argument::type('string'))->shouldNotBeCalled();

        $this
            ->resolve($fixture, 'en_GB', LoaderContext::create('1'))
            ->shouldBeLike($fixture);
    }
}
