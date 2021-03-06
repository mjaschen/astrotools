<?php

declare(strict_types=1);

namespace Astrotools\SolarSystem\Ecliptic;

use Astrotools\Time\JulianCentury;

class Obliquity
{
    public static function getObliquityOfEcliptic(JulianCentury $julianCentury): float
    {
        return 23.4392911111
            - 0.0130041667 * $julianCentury->getCenturies()
            - 0.0000001639 * $julianCentury->getCenturies() ** 2
            + 0.0000005036 * $julianCentury->getCenturies() ** 3;
    }

    public static function getObliquityOfEclipticRadians(JulianCentury $julianCentury): float
    {
        return self::getObliquityOfEcliptic($julianCentury) * M_PI / 180;
    }

    public static function getObliquityOfEclipticEpoch2000(): float
    {
        return 23.4392911;
    }

    public static function getObliquityOfEclipticEpoch2000Radians(): float
    {
        return self::getObliquityOfEclipticEpoch2000() * M_PI / 180;
    }

    public static function getObliquityOfEclipticEpoch1950(): float
    {
        return 23.4457889;
    }

    public static function getObliquityOfEclipticEpoch1950Radians(): float
    {
        return self::getObliquityOfEclipticEpoch1950() * M_PI / 180;
    }
}
