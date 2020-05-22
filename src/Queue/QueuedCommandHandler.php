<?php


namespace Esc\Queue;

use Psr\Log\LoggerInterface;
use Symfony\Component\Process\Process;

class QueuedCommandHandler
{
    private $env;
    private $logger;

    public function __construct(string $env, LoggerInterface $logger)
    {
        $this->env = $env;
        $this->logger = $logger;
    }

    public function __invoke(QueuedCommand $message)
    {
        $argumentString = $this->createArgumentString($message->getParameters());
        $process = Process::fromShellCommandline('bin/console ' . $message->getName() . ' ' . $argumentString);
        $this->logger->info($process->getCommandLine());
        $process->setTimeout(0);
        $process->run();
    }

    private function createArgumentString(array $arguments): string
    {
        $optionList = [];
        foreach ($arguments as $key => $value) {
            if (!is_int($key)) {
                $optionList[] = sprintf('--%s=%s', $key, $value);
                continue;
            }
            $optionList[] = sprintf('%s', $value);
        }
        $optionList[] = sprintf('--env=%s', $this->env);
        return implode(' ', $optionList);
    }
}
