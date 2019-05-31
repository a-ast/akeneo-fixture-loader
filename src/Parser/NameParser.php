<?php

namespace Aa\AkeneoFixtureLoader\Parser;

use Aa\AkeneoFixtureLoader\Parser\Node\Loop;
use Aa\AkeneoFixtureLoader\Parser\Node\NodeInterface;

class NameParser
{
    public function parse(string $name): ?NodeInterface
    {
        $matches = [];

        if (1 === preg_match('/^([\w-]*)_{(\d*)..(\d*)}$/', $name, $matches)) {

            return Loop::create($matches[1], (int)$matches[2], (int)$matches[3]);

        }

        return null;
    }
}
