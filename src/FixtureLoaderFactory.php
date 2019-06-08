<?php

namespace Aa\AkeneoFixtureLoader;

use Aa\AkeneoDataLoader\Api\Credentials;
use Aa\AkeneoDataLoader\Connector\Configuration;
use Aa\AkeneoDataLoader\LoaderFactory;
use Aa\AkeneoDataLoader\LoaderInterface;
use Aa\AkeneoFixtureLoader\Expression\LocalizedResolver;
use Aa\AkeneoFixtureLoader\Expression\ResolverRegistry;
use Aa\AkeneoFixtureLoader\Fixture\FixtureResolver;

class FixtureLoaderFactory
{
    /**
     * @var ?Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration = null)
    {
        $this->configuration = $configuration;
    }

    public function create(LoaderInterface $dataLoader): FixtureLoader
    {
        $expressionResolver = new LocalizedResolver(new ResolverRegistry());
        $fixtureResolver = new FixtureResolver($expressionResolver);

        return new FixtureLoader($dataLoader, $fixtureResolver);
    }

    public function createByCredentials(Credentials $apiCredentials): FixtureLoader
    {
        $loaderFactory = new LoaderFactory($this->configuration);

        $loader = $loaderFactory->createByCredentials($apiCredentials);

        return $this->create($loader);
    }
}
