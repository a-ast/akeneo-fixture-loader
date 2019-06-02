<?php

namespace Aa\AkeneoFixtureLoader;

use Aa\AkeneoDataLoader\LoaderInterface;
use Aa\AkeneoFixtureLoader\Fixture\LoaderContext;
use Aa\AkeneoFixtureLoader\Parser\NameParser;
use Aa\AkeneoFixtureLoader\Parser\Node\Loop;
use Aa\AkeneoFixtureLoader\Fixture\FixtureResolver;
use Traversable;

class FixtureLoader
{
    /**
     * @var LoaderInterface
     */
    private $dataLoader;

    /**
     * @var FixtureResolver
     */
    private $resolver;

    /**
     * @var NameParser
     */
    private $parser;

    /**
     * @var string
     */
    private $defaultLocale;

    public function __construct(LoaderInterface $dataLoader, FixtureResolver $resolver)
    {
        $this->dataLoader = $dataLoader;

        $this->resolver = $resolver;

        $this->parser = new NameParser();

        $this->defaultLocale = 'en_US';
    }

    public function loadData(iterable $fixtures)
    {
        foreach ($fixtures as $name => $fixture) {

            $node = $this->parser->parse($name);

            if ($node instanceof Loop) {

                $nodeName = $node->getName();
                $this->dataLoader->load($nodeName, $this->loop($node, $fixture));
            }
        }
    }

    private function loop(Loop $loop, array $fixture): Traversable
    {
        for ($i = $loop->getStartIndex(); $i <= $loop->getStopIndex(); $i++) {

            $context = LoaderContext::create((string)$i);
            $resolvedFixture = $this->resolver->resolve($fixture, $this->defaultLocale, $context);

            yield $resolvedFixture;
        }
    }
}
