<?php

namespace Fulll\App\Command;

use Fulll\Domain\Repository\FleetRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateFleetCommand extends Command
{
    /**
     * @var FleetRepository $fleetRepository
     */
    private FleetRepository $fleetRepository;

    /**
     * @param FleetRepository $fleetRepository
     */
    public function __construct(FleetRepository $fleetRepository)
    {
        $this->fleetRepository = $fleetRepository;
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('create')
            ->setDescription('Create a user\'s fleet')
            ->addArgument('userId', InputArgument::REQUIRED, 'User Id');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userId = $input->getArgument('userId');
        print("Create Fleet for user $userId\n");

        $repository = $this->fleetRepository;

        $repository->createFleet($userId);
        
        return Command::SUCCESS;
    }
}
