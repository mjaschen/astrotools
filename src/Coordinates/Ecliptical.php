<?php

declare(strict_types=1);

namespace Astrotools\Coordinates;

class Ecliptical
{
    /**
     * @var float Ecliptical longitude in degrees
     */
    private $lambda;

    /**
     * @var float Ecliptical latitude in degrees
     */
    private $beta;

    /**
     * Ecliptical constructor.
     */
    public function __construct(float $lambda, float $beta)
    {
        $this->lambda = $lambda;
        $this->beta = $beta;
    }

    /**
     * @return float
     */
    public function getLambda(): float
    {
        return $this->lambda;
    }

    /**
     * @return float
     */
    public function getBeta(): float
    {
        return $this->beta;
    }
}
