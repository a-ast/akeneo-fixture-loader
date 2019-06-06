<?php

namespace spec\Aa\AkeneoFixtureLoader;

use Aa\AkeneoDataLoader\Api\Configuration;
use Aa\AkeneoDataLoader\Api\Credentials;
use Aa\AkeneoDataLoader\LoaderInterface;
use Aa\AkeneoFixtureLoader\FixtureLoader;
use PhpSpec\ObjectBehavior;

class FixtureLoaderFactorySpec extends ObjectBehavior
{
    function it_creates(LoaderInterface $dataLoader)
    {
        $this->create($dataLoader)->shouldHaveType(FixtureLoader::class);
    }

    function it_creates_by_api_credentials(Credentials $credentials, Configuration $configuration)
    {
        $credentials->getBaseUri()->willReturn('uri');
        $credentials->getClientId()->willReturn('clientId');
        $credentials->getSecret()->willReturn('secret');
        $credentials->getUsername()->willReturn('user');
        $credentials->getPassword()->willReturn('pass');

        $configuration->getUploadDir()->willReturn('/upload');

        $this
            ->createByCredentials($credentials, $configuration)
            ->shouldHaveType(FixtureLoader::class);
    }
}
