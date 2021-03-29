<?php

declare(strict_types=1);

namespace Astrotools\Coordinates;

class Galactical
{
    /**
     * @var float Galactic longitude in degrees
     */
    private $longitude;

    /**
     * @var float Galactic latitude in degrees
     */
    private $latitude;

    public function __construct(float $longitude, float $latitude)
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
}
