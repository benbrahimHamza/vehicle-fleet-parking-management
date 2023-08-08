<?php

namespace Fulll\Domain\Entity;

class Vehicle {

    /** @var int  */
    private int $id;

    /**
     * @var string
     */
    private string $plateNumber;

    /**
     * @var Location | null $location Current location of the vehicle, may be null
     */
    private ?Location $location = null;

    /**
     * @param string $plateNumber
     */
    public function __construct($plateNumber)
    {
        $this->plateNumber = $plateNumber;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPlateNumber(): string
    {
        return $this->plateNumber;
    }

    /**
     * @return Location | null
     */
    public function getLocation(): ?Location
    {
        return $this->location;
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
     * @param string $plateNumber Would have used it as identifier but no harm in twice the identifiers
     * @return $this
     */
    public function setPlateNumber($plateNumber) 
    {
        $this->plateNumber = $plateNumber;
        return $this;
    }

    /**
     * @param Location | null $location
     * @return $this
     */
    public function setLocation($location) 
    {
        $this->location = $location;
        return $this;
    }
}