<?php

namespace Fulll\App\Command;

use Exception;
use Fulll\Domain\Repository\FleetRepository;
use Fulll\Domain\Repository\VehicleRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RegisterVehicleCommand extends Command
{
    /**
     * @var FleetRepository $fleetRepository
     */
    private FleetRepository $fleetRepository;

    /**
     * @var VehicleRepository $vehicleRepository
     */
    private VehicleRepository $vehicleRepository;

    /**
     * @param FleetRepository $fleetRepository
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct(FleetRepository $fleetRepository, VehicleRepository $vehicleRepository)
    {
        $this->fleetRepository = $fleetRepository;
        $this->vehicleRepository = $vehicleRepository;
        parent::__construct();
    }

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
        print("Registering Vehicles\n");
        $fleetId = $input->getArgument('fleetId');
        $vehiclePlateNumber = $input->getArgument('vehiclePlateNumber');

        // Retrieve fleet
        $fleet = $this->fleetRepository->find($fleetId);

        if (!$fleet) {
            throw new Exception('No fleet matches this id');
        }

        // Retrieve vehicle
        $vehicle = $this->vehicleRepository->findByPlateNumber($vehiclePlateNumber);

        if(!$vehicle) {
            throw new Exception('No vehicle matches this plate number');
        }

        $fleetRegisteredVehicleIds = $this->vehicleRepository->findVehicleIdsByFleetId($fleet->getId());

        if ($fleetRegisteredVehicleIds && in_array($vehicle->getId(), $fleetRegisteredVehicleIds)) {
            throw new Exception('This vehicle has already been registered');
        }

        $this->fleetRepository->registerVehicle($fleet, $vehicle);

        return Command::SUCCESS;
    }
}
