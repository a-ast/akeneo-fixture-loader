<?php

namespace Aa\AkeneoFixtureLoader\Resolver;

use Aa\AkeneoFixtureLoader\Expression\LocalizedResolver;

class FixtureResolver
{
    /**
     * @var LocalizedResolver
     */
    private $resolver;

    public function __construct(LocalizedResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function resolve(array $fixture, string $locale = '')
    {
        foreach ($fixture as $item)
        {
            if (is_array($item)) {
                $this->resolve($item);

                continue;
            }

            $this->resolver->resolve($item, $locale);
        }
    }
}
