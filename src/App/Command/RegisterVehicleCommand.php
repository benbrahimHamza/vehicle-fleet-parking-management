<?php

namespace Fulll\App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RegisterVehicleCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('register-vehicle')
            ->setDescription('Register vehicle to an existing fleet')
            ->addArgument('fleetId', InputArgument::REQUIRED, 'Fleet Id')
            ->addArgument('vehiclePlateNumber', InputArgument::REQUIRED, 'Vehicle plate number');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        print("Register Vehicle");
        return Command::SUCCESS;
    }
}
