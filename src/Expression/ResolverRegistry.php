<?php

namespace Aa\AkeneoFixtureLoader\Expression;

use Aa\AkeneoFixtureLoader\Faker\FakerAdapter;
use Faker\Factory;

class ResolverRegistry
{
    /**
     * @var array
     */
    private $resolvers;

    public function __construct()
    {
        $this->resolvers = [];
    }

    public function get(string $locale): Resolver
    {
        if (!isset($this->resolvers[$locale])) {
            $generator = $this->getGenerator($locale);
            $faker = new FakerAdapter($generator);

            $this->resolvers[$locale] = new Resolver($faker);
        }

        return $this->resolvers[$locale];
    }

    private function getGenerator(string $locale): \Faker\Generator
    {
        if ('' === $locale) {
            return Factory::create();
        }

        return Factory::create($locale);
    }
}
