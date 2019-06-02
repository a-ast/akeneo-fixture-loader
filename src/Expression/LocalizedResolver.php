<?php

namespace Aa\AkeneoFixtureLoader\Expression;

use Aa\AkeneoFixtureLoader\Fixture\LoaderContext;

class LocalizedResolver
{
    /**
     * @var ResolverRegistry
     */
    private $registry;

    public function __construct(ResolverRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function resolve(string $expression, string $locale, LoaderContext $context)
    {
        $resolver = $this->registry->get($locale);

        return $resolver->resolve($expression, $context);
    }
}
