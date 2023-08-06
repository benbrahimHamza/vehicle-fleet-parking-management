<?php

namespace Fulll\Infrastructure\Connection;

use Exception;
use PDO;

class PDOConnection
{
    /**
     * @var PDO
     */
    private PDO $pdoConnection;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        try {
            $this->pdoConnection = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8', $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        } catch (Exception $e) {
            throw($e);
        }
    }

    /**
     * @return PDO
     */
    public function getPDOConnection(): PDO
    {
        return $this->pdoConnection;
    }
}
