<?php

namespace Aa\AkeneoFixtureLoader\Faker;

use Faker\Generator;

class FakerAdapter
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    public function fake(string $functionName, array $arguments = [])
    {
        return $this->faker->format($functionName, $arguments);
    }
}
