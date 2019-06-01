<?php

namespace spec\Aa\AkeneoFixtureLoader\Expression;

use Aa\AkeneoFixtureLoader\Faker\FakerAdapter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResolverSpec extends ObjectBehavior
{
    function let(FakerAdapter $faker)
    {
        $this->beConstructedWith($faker);
    }

    function it_resolves_a_simple_expression(FakerAdapter $faker)
    {
        $faker->fake('expression', [])->shouldBeCalled();

        $this->resolve('< expression() >');
    }

    function it_resolves_a_complex_expression(FakerAdapter $faker)
    {
        $faker->fake('expr1', ['textParam', 120])->shouldBeCalled();
        $faker->fake('expr2', [800, 'text'])->shouldBeCalled();

        $this->resolve('First expression  one < expr1("textParam", 120) >, then expression 2 <expr2(800, "text")>, that\'s all');
    }

    function it_does_not_modify_a_text_if_it_is_not_an_expression(FakerAdapter $faker)
    {
        $faker->fake(Argument::type('string'), Argument::type('array'))->shouldNotBeCalled();

        $this->resolve('it is not an expression');
    }
}
