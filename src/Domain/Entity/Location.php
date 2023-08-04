<?php

namespace Fulll\Domain\Entity;

class Location {
    /** @var float */
    private float $latitude;
    
    /** @var float */
    private float $longitude;

    /**
     * @param float $latitude Latitude coordinates
     * @param float $longitude Longitude coordinates
     */
    public function __construct($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $latitude
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @param float $longitude
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->$longitude = $longitude;
        return $this;
    }
}