<?php

namespace spec\Aa\AkeneoFixtureLoader;

use Aa\AkeneoDataLoader\Api\Credentials;
use Aa\AkeneoDataLoader\Connector\Configuration;
use Aa\AkeneoDataLoader\LoaderInterface;
use Aa\AkeneoFixtureLoader\FixtureLoader;
use PhpSpec\ObjectBehavior;

class FixtureLoaderFactorySpec extends ObjectBehavior
{
    function let(Configuration $configuration)
    {
        $this->beConstructedWith($configuration);

        $configuration->getUploadDir()->willReturn('/upload');
    }

    function it_creates(LoaderInterface $dataLoader)
    {
        $this->create($dataLoader)->shouldHaveType(FixtureLoader::class);
    }

    function it_creates_by_api_credentials(Credentials $credentials)
    {
        $credentials->getBaseUri()->willReturn('uri');
        $credentials->getClientId()->willReturn('clientId');
        $credentials->getSecret()->willReturn('secret');
        $credentials->getUsername()->willReturn('user');
        $credentials->getPassword()->willReturn('pass');

        $this
            ->createByCredentials($credentials)
            ->shouldHaveType(FixtureLoader::class);
    }
}
