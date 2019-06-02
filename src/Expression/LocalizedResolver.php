<?php

namespace Aa\AkeneoFixtureLoader\Expression;

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

    public function resolve(string $expression, string $locale)
    {
        $resolver = $this->registry->get($locale);

        return $resolver->resolve($expression);
    }
}
