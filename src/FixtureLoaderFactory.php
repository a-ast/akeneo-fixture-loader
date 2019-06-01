<?php

namespace Aa\AkeneoFixtureLoader;

use Aa\AkeneoDataLoader\LoaderInterface;
use Aa\AkeneoFixtureLoader\Expression\LocalizedResolver;
use Aa\AkeneoFixtureLoader\Expression\ResolverRegistry;
use Aa\AkeneoFixtureLoader\Fixture\FixtureResolver;

class FixtureLoaderFactory
{
    public function create(LoaderInterface $dataLoader): FixtureLoader
    {
        $expressionResolver = new LocalizedResolver(new ResolverRegistry());
        $fixtureResolver = new FixtureResolver($expressionResolver);

        return new FixtureLoader($dataLoader, $fixtureResolver);
    }
}
