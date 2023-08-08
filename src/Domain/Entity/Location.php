<?php

namespace Fulll\Domain\Entity;

class Location
{
    /** @var float */
    private float $longitude;

    /** @var float */
    private float $latitude;

    /**
     * @param float $longitude Longitude coordinates
     * @param float $latitude Latitude coordinates
     */
    public function __construct($longitude, $latitude)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
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

    /**
     * @param float $latitude
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }
}
