<?php

namespace ESC\Queue;

class QueuedCommand
{
    /**
     * @var string
     */
    private $name;

    /** @var string */
    private $username;

    /**
     * @var array
     */
    private $parameters;

    public function __construct(string $name, string $username, array $parameters)
    {
        $this->name = $name;
        $this->username = $username;
        $this->parameters = $parameters;
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
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
}
