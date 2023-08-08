<?php

namespace Fulll\Infra\Connection;

use Exception;
use PDO;
use PDOException;

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
            $this->pdoConnection = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=' . $_ENV['DB_CHARSET'] . ';port=' . $_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        } catch (PDOException $e) {
            throw ($e);
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
