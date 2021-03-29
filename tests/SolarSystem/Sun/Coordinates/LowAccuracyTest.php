<?php

declare(strict_types=1);

namespace Astrotools\Tests\SolarSystem\Sun\Coordinates;

use Astrotools\Coordinates\Equatorial;
use Astrotools\SolarSystem\Sun\Coordinates\LowAccuracy;
use Astrotools\Time\JulianDay;
use PHPUnit\Framework\TestCase;

class LowAccuracyTest extends TestCase
{
    public function testJDE24489085WorksAsExpected(): void
    {
        $expected = new Equatorial(198.38082, -7.78507);
        $actual = LowAccuracy::getForJulianDay(new JulianDay(2448908.5));

        self::assertEqualsWithDelta($expected->getRectascension(), $actual->getRectascension(), 0.000005);
        self::assertEqualsWithDelta($expected->getDeclination(), $actual->getDeclination(), 0.000005);
    }
}
