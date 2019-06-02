<?php

namespace Aa\AkeneoFixtureLoader\Fixture;

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

    public function resolve(array $fixture, string $locale, LoaderContext $context): array
    {
        $this->recursiveResolve($fixture, $locale, $context);

        return $fixture;
    }

    private function recursiveResolve(array &$fixture, string $locale, LoaderContext $context)
    {
        foreach ($fixture as &$item)
        {
            if (is_array($item)) {
                $this->recursiveResolve($item, $locale, $context);

                continue;
            }

            if (null === $item) {
                continue;
            }

            $item = $this->resolver->resolve($item, $locale, $context);
        }
    }
}
