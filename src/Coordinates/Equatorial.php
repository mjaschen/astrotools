<?php

declare(strict_types=1);

namespace Astrotools\Coordinates;

class Equatorial
{
    /**
     * @var float
     */
    private $rectascension;

    /**
     * @var float
     */
    private $declination;

    /**
     * PolarCoordinates constructor.
     */
    public function __construct(float $rectascension, float $declination)
    {
        $this->rectascension = $rectascension;
        $this->declination = $declination;
    }

    /**
     * @return float
     */
    public function getRectascension(): float
    {
        return $this->rectascension;
    }

    /**
     * @return float
     */
    public function getDeclination(): float
    {
        return $this->declination;
    }
}
