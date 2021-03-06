<?php

namespace spec\Aa\AkeneoFixtureLoader;

use Aa\AkeneoDataLoader\LoaderInterface;
use Aa\AkeneoFixtureLoader\Fixture\FixtureResolver;
use Aa\AkeneoFixtureLoader\Fixture\LoaderContext;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Webmozart\Assert\Assert;

class FixtureLoaderSpec extends ObjectBehavior
{
    function it_loads_data_in_loop(FixtureResolver $resolver)
    {
        $spyLoader = new SpyLoader();
        $this->beConstructedWith($spyLoader, $resolver);

        $fixtureData  = ['color' => 'green'];

        $resolver->resolve($fixtureData, Argument::type('string'), Argument::type(LoaderContext::class))->willReturn($fixtureData)->shouldBeCalledTimes(5);

        $this->loadData(['apple_{1..5}' => $fixtureData]);

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
