<?php

namespace Aa\AkeneoFixtureLoader\Expression;

use Aa\AkeneoFixtureLoader\Faker\FakerAdapter;

class Resolver
{
    /**
     * @var \Aa\AkeneoFixtureLoader\Faker\FakerAdapter
     */
    private $faker;

    public function __construct(FakerAdapter $faker)
    {
        $this->faker = $faker;
    }

    public function resolve(string $expression)
    {
        return $this->faker->fake($expression, []);
    }
}
