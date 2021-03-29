<?php

declare(strict_types=1);

namespace Astrotools\Time;

class JulianCentury
{
    /**
     * @var float
     */
    private $value;

    public function __construct(JulianDay $julianDay, JulianDay $reference)
    {
        $this->value = ($julianDay->getValue() - $reference->getValue()) / 36525;
    }

    public function getCenturies(): float
    {
        return $this->value;
    }
}
