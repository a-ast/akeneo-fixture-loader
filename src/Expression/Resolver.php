<?php

namespace Aa\AkeneoFixtureLoader\Expression;

use Aa\AkeneoFixtureLoader\Faker\FakerAdapter;
use Aa\AkeneoFixtureLoader\Fixture\LoaderContext;

class Resolver
{
    /**
     * @var \Aa\AkeneoFixtureLoader\Faker\FakerAdapter
     */
    private $faker;

    /**
     * @var LoaderContext
     */
    private $currentContext;

    public function __construct(FakerAdapter $faker)
    {
        $this->faker = $faker;
    }

    public function resolve(string $expression, LoaderContext $context)
    {
        $this->currentContext = $context;

        return preg_replace_callback('/\<\s?(\w+)\(([^\)]*)\)\s?\>/', [$this, 'fake'], $expression);
    }

    private function fake(array $matches)
    {
        $name = $matches[1];

        if ('current' === $name) {
            return $this->currentContext->getCurrentIndex();
        }

        $arguments = $this->parseArguments($matches[2]);

        return $this->faker->fake($name, $arguments);
    }

    private function parseArguments(string $argumentText): array
    {
        if ('' === trim($argumentText)) {
            return [];
        }

        return array_map(function(string $text) {

            return trim(trim($text), '"\'');

        }, explode(',', $argumentText));
    }
}
