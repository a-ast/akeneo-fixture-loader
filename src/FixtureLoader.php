<?php

namespace Aa\AkeneoFixtureLoader;

use Aa\AkeneoDataLoader\LoaderInterface;
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

    public function __construct(LoaderInterface $dataLoader, FixtureResolver $resolver)
    {
        $this->dataLoader = $dataLoader;

        $this->resolver = $resolver;

        $this->parser = new NameParser();
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

            $resolvedFixture = $this->resolver->resolve($fixture);

            yield $resolvedFixture;
        }
    }
}
