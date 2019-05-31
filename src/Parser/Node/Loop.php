<?php

namespace Aa\AkeneoFixtureLoader\Parser\Node;

class Loop implements NodeInterface
{
    /**
     * @var int
     */
    private $start;

    /**
     * @var int
     */
    private $stop;

    /**
     * @var string
     */
    private $name;

    private function __construct(string $name, int $start, int $stop)
    {
        $this->name = $name;
        $this->start = $start;
        $this->stop = $stop;
    }

    public static function create(string $name, int $start, int $stop)
    {
        return new static($name, $start, $stop);
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getStartIndex(): int
    {
        return $this->start;
    }

    public function getStopIndex(): int
    {
        return $this->stop;
    }
}
