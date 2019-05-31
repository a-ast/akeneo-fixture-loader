<?php

namespace spec\Aa\AkeneoFixtureLoader\Loader;

use Aa\AkeneoDataLoader\LoaderInterface;
use PhpSpec\ObjectBehavior;
use Webmozart\Assert\Assert;

class LoaderSpec extends ObjectBehavior
{
    function it_loads_data_in_loop(LoaderInterface $loader)
    {
        $spyLoader = new SpyLoader();
        $this->beConstructedWith($spyLoader);

        $fixtureData  = ['color' => 'green'];


        $this->load(['apple_{1..5}' => $fixtureData]);

        Assert::eq($spyLoader->calledApiAlias, 'apple');
        Assert::same($spyLoader->calledDataProvider, array_fill(0, 5, $fixtureData));
    }
}

class SpyLoader implements LoaderInterface
{
    public $calledApiAlias;

    public $calledDataProvider;

    public function load(string $apiAlias, iterable $dataProvider)
    {
        $this->calledApiAlias = $apiAlias;

        $this->calledDataProvider = iterator_to_array($dataProvider);
    }
}
