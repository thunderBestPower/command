<?php

namespace BlueWeb;

use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

abstract class UsernameCommand extends SymfonyCommand
{
    //Required for command registration
    protected static $defaultName = 'bluewebmv:usernamecommand';

    protected $logger;
    protected $username;

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct();
        $this->logger = $logger;
    }

    protected function configure()
    {
        $this->addOption(
            'username',
            null,
            InputOption::VALUE_REQUIRED
        );
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->username = $input->getOption('username');
    }
}
