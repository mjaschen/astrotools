<?php

declare(strict_types=1);

namespace Astrotools\Coordinates;

class Equatorial
{
    /**
     * @var float Right Ascension in degrees
     */
    private $rightascension;

    /**
     * @var float Declination in degrees
     */
    private $declination;

    /**
     * PolarCoordinates constructor.
     */
    public function __construct(float $rightascension, float $declination)
    {
        $this->rightascension = $rightascension;
        $this->declination = $declination;
    }

    /**
     * @return float
     */
    public function getRightascension(): float
    {
        return $this->rightascension;
    }

    /**
     * @return float
     */
    public function getDeclination(): float
    {
        return $this->declination;
    }
}
