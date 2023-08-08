<?php

namespace Fulll\App\Command;

use Fulll\Domain\Entity\Location;
use Fulll\Domain\Repository\FleetRepository;
use Fulll\Domain\Repository\VehicleRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateVehiclesAndLocationsCommand extends Command
{
    /**
     * @var VehicleRepository $vehicleRepository
     */
    private VehicleRepository $vehicleRepository;

    /**
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('init')
            ->setDescription('Create vehicles and locations for testing purposes');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        print("Creating Vehicles and random locations\n");

        $this->vehicleRepository->createVehicle('AAA111', new Location(48.858331, 2.294270));
        $this->vehicleRepository->createVehicle('BBB222', new Location(43.531723, 5.614897));
        $this->vehicleRepository->createVehicle('CCC333', new Location(43.4138709,5.4423174));
        
        return Command::SUCCESS;
    }
}
