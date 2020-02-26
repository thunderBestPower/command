<?php

namespace Esc;

use Esc\User\Repository\EscUserRepository;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends SymfonyCommand
{
    //Required for command registration
    protected static $defaultName = 'esc:command';

    protected $logger;
    protected $userId;
    private $userRepository;

    public function __construct(LoggerInterface $logger, EscUserRepository $userRepository)
    {
        parent::__construct();
        $this->logger = $logger;
        $this->userRepository = $userRepository;
    }

    protected function configure()
    {
        $this->addOption(
            'username',
            null,
            InputOption::VALUE_OPTIONAL,
            'username dell\'utente che lancia il comamnd',
            'admin'
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
        $username = $input->getOption('username');

        $this->userId = $this->getUsernameId($username);
    }
    /**
     * Restituisce id dell'utente
     *
     * @param $username
     * @return int
     * @throws Exception
     */
    protected function getUsernameId($username): int
    {
        $user = $this->userRepository->getOneById($username);
        return $user->getId();
    }
}
