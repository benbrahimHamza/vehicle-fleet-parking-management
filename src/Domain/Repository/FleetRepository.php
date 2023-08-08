<?php

namespace Fulll\Domain\Repository;

use Exception;
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
}