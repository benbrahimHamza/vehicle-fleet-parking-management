<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Fulll\Domain\Entity\Fleet;
use Fulll\Domain\Repository\FleetRepository;
use Fulll\Domain\Repository\VehicleRepository;
use Symfony\Component\Dotenv\Dotenv;

class RegisterVehicleContext implements Context
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
     * @var int $currentUserId
     */
    private int $currentUserId;

    /**
     * @var string $currentPlateNumber
     */
    private string $currentPlateNumber;

    /**
     * @BeforeSuite
     */
    public static function prepare()
    {
        $dotenv = new Dotenv();
        $dotenv->loadEnv(__DIR__ . '/../../.env');
    }

    /**
     * @BeforeScenario
     */
    public function before()
    {
        $this->fleetRepository = new FleetRepository();
        $this->vehicleRepository = new VehicleRepository();
        $this->currentUserId = rand();
        $this->currentPlateNumber = 'test' . rand();
    }

    /**
     * @Given my fleet
     */
    public function myFleet()
    {
        $this->fleetRepository->createFleet($this->currentUserId);
    }

    /**
     * @Given a vehicle
     */
    public function aVehicle()
    {
        $this->vehicleRepository->createVehicle($this->currentPlateNumber);
    }

    /**
     * @When I register this vehicle into my fleet
     */
    public function iRegisterThisVehicleIntoMyFleet()
    {
        $fleet = $this->fleetRepository->find($this->currentUserId);
        $vehicle = $this->vehicleRepository->findByPlateNumber($this->currentPlateNumber);

        $this->fleetRepository->registerVehicle($fleet, $vehicle);
    }

    /**
     * @Then this vehicle should be part of my vehicle fleet
     */
    public function thisVehicleShouldBePartOfMyVehicleFleet()
    {
        $this->vehicleRepository->findVehicleIdsByFleetId($this->currentUserId);
    }

    /**
     * @Given I have registered this vehicle into my fleet
     */
    public function iHaveRegisteredThisVehicleIntoMyFleet()
    {
        $this->vehicleRepository->findVehicleIdsByFleetId($this->currentUserId);
    }

    /**
     * @When I try to register this vehicle into my fleet
     */
    public function iTryToRegisterThisVehicleIntoMyFleet()
    {
        throw new Exception();
    }

    /**
     * @Then I should be informed this this vehicle has already been registered into my fleet
     */
    public function iShouldBeInformedThisThisVehicleHasAlreadyBeenRegisteredIntoMyFleet()
    {
        throw new Exception();
    }

    /**
     * @Given the fleet of another user
     */
    public function theFleetOfAnotherUser()
    {
        throw new Exception();
    }

    /**
     * @Given this vehicle has been registered into the other user's fleet
     */
    public function thisVehicleHasBeenRegisteredIntoTheOtherUsersFleet()
    {
        throw new Exception();
    }
}
