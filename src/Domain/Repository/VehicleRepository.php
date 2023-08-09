<?php

namespace Fulll\Domain\Repository;

use Exception;
use Fulll\Domain\Entity\Location;
use Fulll\Domain\Entity\Vehicle;
use Fulll\Infra\Connection\PDOConnection;

class VehicleRepository
{
    /**
     * @param string $plateNumber Plate number to associate with the vehicle
     * @param Location | null $location Current location of the vehicle, can be null
     * @return string Return vehicle plate number
     * @throws Exception
     */
    public function createVehicle(string $plateNumber, ?Location $location = null): string
    {
        $pdo = new PDOConnection();
        $conn = $pdo->getPDOConnection();

        $query = 'INSERT INTO Vehicle (plateNumber) VALUE (:plateNumber)';

        if ($location) {
            $query = 'INSERT INTO Vehicle (plateNumber, longPos, latPos) VALUE (:plateNumber, :longPos, :latPos)';
        }

        try {
            $statement = $conn->prepare($query);
            $statement->bindValue(':plateNumber', $plateNumber);
            if ($location) {
                $statement->bindValue(':longPos', $location->getLongitude());
                $statement->bindValue(':latPos', $location->getLatitude());
            }
            $statement->execute();
        } catch(Exception $e) {
            throw $e;
        }

        return $plateNumber;
    }

    /**
     * @param string $plateNumber
     * @return Vehicle | null
     */
    public function findByPlateNumber(string $plateNumber): ?Vehicle
    {
        $pdo = new PDOConnection();
        $conn = $pdo->getPDOConnection();
        $query = 'SELECT * FROM Vehicle WHERE plateNumber = :plateNumber';
        $statement = $conn->prepare($query);
        $statement->bindValue(':plateNumber', $plateNumber);
        $statement->execute();

        $vehicleData = $statement->fetch();

        // Fetch returns false when no vehicle is found
        if (!$vehicleData) {
            return null;
        }

        $vehicle = new Vehicle($vehicleData['plateNumber']);
        $vehicle->setId($vehicleData['id'])
            ->setLocation(new Location($vehicleData['longPos'], $vehicleData['latPos']));

        return $vehicle;
    }

    /**
     * @param int $idFleet
     * @return array<int> | null
     */
    public function findVehicleIdsByFleetId(int $idFleet): ?array
    {
        $pdo = new PDOConnection();
        $conn = $pdo->getPDOConnection();

        $query = 'SELECT * FROM FleetVehicle WHERE idFleet = :idFleet';
        $statement = $conn->prepare($query);
        $statement->bindValue(':idFleet', $idFleet);
        $statement->execute();

        $vehicleData = $statement->fetchAll();

        if (!$vehicleData) {
            return null;
        }

        $vehicles = [];

        foreach ($vehicleData as $vehicleRow) {
            $vehicles[] = $vehicleRow['idVehicle'];
        }

        return $vehicles;
    }
}
