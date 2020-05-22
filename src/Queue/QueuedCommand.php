<?php

namespace Esc\Queue;

class QueuedCommand
{
    /**
     * @var string
     */
    private $name;

    /** @var int */
    private $timeout;

    /**
     * @var array
     */
    private $parameters;

    public function __construct(string $name, array $parameters = [], int $timeout = 0)
    {
        $this->name = $name;
        $this->parameters = $parameters;
        $this->timeout = $timeout;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }
}
