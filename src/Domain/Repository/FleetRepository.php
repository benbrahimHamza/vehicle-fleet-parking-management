<?php

namespace Fulll\Domain\Repository;

use Exception;
use Fulll\Domain\Entity\Fleet;
use Fulll\Domain\Entity\Vehicle;
use Fulll\Infra\Connection\PDOConnection;

class FleetRepository
{
    /**
     * @param int $userId UserId to associate with the fleet
     * @return int Return fleet owner Id 
     * @throws Exception
     */
    public function createFleet(int $userId): int
    {
        $pdo = new PDOConnection();
        $conn = $pdo->getPDOConnection();
        $query = 'INSERT INTO Fleet (userId) VALUE (:userId)';

        try {
            $statement = $conn->prepare($query);
            $statement->bindValue(':userId', $userId);
            $statement->execute();
        } catch(Exception $e) {
            throw $e;
        }

        return $userId;
    }

    /**
     * @param int $id Fleet id
     * @return Fleet | null
     */
    public function find(int $id): ?Fleet
    {
        $pdo = new PDOConnection();
        $conn = $pdo->getPDOConnection();
        $query = 'SELECT * FROM Fleet WHERE id = :id';
        $statement = $conn->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $fleetData = $statement->fetch();

        // Fetch returns false when no fleet is found
        if (!$fleetData) {
            return null;
        }

        $fleet = new Fleet($fleetData['userId']);
        $fleet->setId($fleetData['id']);

        return $fleet;
    }

    /**
     * @param Fleet $fleet
     * @param Vehicle $vehicle
     * @return void
     */
    public function registerVehicle(Fleet $fleet, Vehicle $vehicle): void
    {
        $pdo = new PDOConnection();
        $conn = $pdo->getPDOConnection();
        $query = 'INSERT INTO FleetVehicle (idFleet, idVehicle) VALUES (:idFleet, :idVehicle)';
        $statement = $conn->prepare($query);
        $statement->bindValue(':idFleet', $fleet->getId());
        $statement->bindValue(':idVehicle', $vehicle->getId());
        $statement->execute();
    }
}