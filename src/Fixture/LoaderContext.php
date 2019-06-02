<?php

namespace Aa\AkeneoFixtureLoader\Fixture;

class LoaderContext
{
    /**
     * @var string
     */
    private $currentIndex;

    private function __construct(string $currentIndex)
    {
        $this->currentIndex = $currentIndex;
    }

    public static function create(string $currentIndex)
    {
        return new static($currentIndex);
    }

    public function getCurrentIndex(): string
    {
        return $this->currentIndex;
    }
}
