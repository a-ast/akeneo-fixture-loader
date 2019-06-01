<?php

namespace spec\Aa\AkeneoFixtureLoader;

use Aa\AkeneoDataLoader\LoaderInterface;
use Aa\AkeneoFixtureLoader\FixtureLoader;
use PhpSpec\ObjectBehavior;

class FixtureLoaderFactorySpec extends ObjectBehavior
{
    function it_creates(LoaderInterface $dataLoader)
    {
        $this->create($dataLoader)->shouldHaveType(FixtureLoader::class);
    }
}
