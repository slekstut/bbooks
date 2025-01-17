<?php

namespace App\Command;

use App\Repository\KnygaRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:list-knygos',
    description: 'Lists all books from the Knyga table.',
)]
class ListKnygosCommand extends Command
{
    private KnygaRepository $knygaRepository;

    public function __construct(KnygaRepository $knygaRepository)
    {
        parent::__construct();
        $this->knygaRepository = $knygaRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $knygos = $this->knygaRepository->findAll();

        if (empty($knygos)) {
            $output->writeln('<comment>No books found in the database.</comment>');
            return Command::SUCCESS;
        }

        $output->writeln('<info>List of Books:</info>');
        $output->writeln(str_pad('-', 50, '-'));

        foreach ($knygos as $knyga) {
            $output->writeln(sprintf(
                'ID: %d | Title: %s | Author: %s | Published Date: %s',
                $knyga->getId(),
                $knyga->getTitle(),
                $knyga->getAuthor(),
                $knyga->getPublishedDate()?->format('Y-m-d') ?? 'N/A'
            ));
        }

        $output->writeln(str_pad('-', 50, '-'));
        return Command::SUCCESS;
    }
}
