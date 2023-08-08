<?php

namespace Fulll\Domain\Repository;

use Exception;
use Fulll\Domain\Entity\Location;
use Fulll\Infra\Connection\PDOConnection;

class VehicleRepository
{
    /**
     * @param string $plateNumber Plate number to associate with the vehicle
     * @param Location | null $location Current location of the vehicle, can be null
     * @return string Return vehicle plate number
     * @throws Exception
     */
    public function createVehicle(string $plateNumber, ?Location $location): string
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
}
