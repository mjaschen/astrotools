<?php

declare(strict_types=1);

namespace Astrotools\SolarSystem\Sun\Coordinates;

use Astrotools\Coordinates\Equatorial;
use Astrotools\Helper\Angle;
use Astrotools\SolarSystem\Ecliptic\Obliquity;
use Astrotools\Time\JulianCentury;
use Astrotools\Time\JulianDay;

class LowAccuracy
{
    public static function getForJulianDay(JulianDay $julianDay): Equatorial
    {
        $julianCentury = new JulianCentury($julianDay, new JulianDay(2451545.0));
        $julianCenturies2000 = $julianCentury->getCenturies();

        $meanLongitude = 280.46645
            + 36000.76983 * $julianCenturies2000
            + 0.0003032 * $julianCenturies2000 ** 2;
        $meanLongitude = Angle::normalizeDegrees($meanLongitude);

        $meanAnomaly = 357.52910
            + 35999.05030 * $julianCenturies2000
            + 0.0001559 * $julianCenturies2000 ** 2
            - 0.00000048 * $julianCenturies2000 ** 3;
        $meanAnomaly = Angle::normalizeDegrees($meanAnomaly);
        $meanAnomalyRadians = deg2rad($meanAnomaly);

        $equationOfCenter = (
                1.914600
                - 0.004817 * $julianCenturies2000
                - 0.000014 * $julianCenturies2000 ** 2
            ) * sin($meanAnomalyRadians)
            + (0.019993 - 0.000101 * $julianCenturies2000) * sin(2 * $meanAnomalyRadians)
            + 0.000290 * sin(3 * $meanAnomalyRadians);

        $trueLongitude = $meanLongitude + $equationOfCenter;

        $omega = 125.04 - 1934.136 * $julianCenturies2000;
        $apparentLongitude = $trueLongitude - 0.00569 - 0.00478 * sin(deg2rad($omega));
        $apparentLongitudeRadians = deg2rad($apparentLongitude);

        $obliquity = Obliquity::getObliquityOfEclipticRadians($julianCentury);
        $obliquityCorrected = $obliquity + deg2rad(0.00256 * cos(deg2rad($omega)));

        $rectascension = Angle::normalizeDegrees(
            rad2deg(
                atan2(
                    cos($obliquityCorrected) * sin($apparentLongitudeRadians),
                    cos($apparentLongitudeRadians)
                )
            )
        );
        $declination = rad2deg(
            asin(sin($obliquityCorrected) * sin($apparentLongitudeRadians))
        );

        return new Equatorial($rectascension, $declination);
    }
}
