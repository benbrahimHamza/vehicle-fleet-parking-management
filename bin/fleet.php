<?php

require __DIR__ . '/../vendor/autoload.php';

use Fulll\App\Command\CreateFleetCommand;
use Fulll\App\Command\CreateVehiclesAndLocationsCommand;
use Fulll\App\Command\LocalizeVehicleCommand;
use Fulll\App\Command\RegisterVehicleCommand;
use Fulll\Domain\Repository\FleetRepository;
use Fulll\Domain\Repository\VehicleRepository;
use Symfony\Component\Console\Application;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');

$application = new Application();

$application->add(new CreateFleetCommand(new FleetRepository()));
$application->add(new LocalizeVehicleCommand(new FleetRepository(), new VehicleRepository()));
$application->add(new RegisterVehicleCommand(new FleetRepository(), new VehicleRepository()));

$application->add(new CreateVehiclesAndLocationsCommand(new VehicleRepository()));

$application->run();