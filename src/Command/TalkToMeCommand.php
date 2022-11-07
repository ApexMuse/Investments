<?php

namespace App\Command;

use App\Repository\AccountRepository;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:talk-to-me',
    description: 'A self-aware command that can do only one thing.',
)]
class TalkToMeCommand extends Command
{
    public function __construct(
        private AccountRepository $account_repository
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::OPTIONAL, 'Your name')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'Shall I yell?')
        ;
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name') ?: 'Whoever you are';
        $should_yell = $input->getOption('yell');

        $message = 'Hey ' . $name . '!';

        if ($should_yell) {
            $message = strtoupper($message);
        }

        $io->success($message);

        if ($io->confirm('Do you want an account recommendation?')) {
             $accounts = $this->account_repository->findAll();
             $account = $accounts[array_rand($accounts)];
             $io->note('I recommend the account: ' . $account['name']);
        }

        return Command::SUCCESS;
    }
}
