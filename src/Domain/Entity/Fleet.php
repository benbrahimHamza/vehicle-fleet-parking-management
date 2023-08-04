<?php

namespace Fulll\App\Domain\Entity;

class Fleet {

    /** @var int  */
    private int $id;

    /** @var int  */
    private int $userId;

    /**
     * @var array
     */
    private array $vehicles = [];

    /**
     * @param int $userId Id of the fleet owner
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return array
     */
    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id) 
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param int $userId
     * @return $this
     */
    public function setUserId($userId) 
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param Vehicle $vehicle
     */
    public function addVehicle($vehicle) 
    {
        $this->vehicles[] = $vehicle;
    }
}