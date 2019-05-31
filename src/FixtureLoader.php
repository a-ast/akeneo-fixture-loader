<?php

namespace Aa\AkeneoFixtureLoader;

use Aa\AkeneoDataLoader\LoaderInterface;
use Aa\AkeneoFixtureLoader\Parser\NameParser;
use Aa\AkeneoFixtureLoader\Parser\Node\Loop;
use Traversable;

class FixtureLoader
{
    /**
     * @var LoaderInterface
     */
    private $dataLoader;

    /**
     * @var NameParser
     */
    private $parser;

    public function __construct(LoaderInterface $dataLoader)
    {
        $this->dataLoader = $dataLoader;

        $this->parser = new NameParser();
    }

    public function loadData(iterable $fixtures)
    {
        foreach ($fixtures as $name => $fixture) {

            $node = $this->parser->parse($name);

            if ($node instanceof Loop) {
                $this->dataLoader->load($node->getName(), $this->loop($node, $fixture));
            }
        }
    }

    private function loop(Loop $loop, array $fixture): Traversable
    {
        for ($i = $loop->getStartIndex(); $i <= $loop->getStopIndex(); $i++) {
            yield $fixture;
        }
    }
}
