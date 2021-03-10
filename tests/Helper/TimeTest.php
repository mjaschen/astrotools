<?php

declare(strict_types=1);

namespace Astrotools\Tests\Helper;

use Astrotools\Helper\Time;

/**
 * Test cases for Time class.
 *
 * @category Astrotools
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @see     https://www.marcusjaschen.de/
 */
class TimeTest extends \PHPUnit\Framework\TestCase
{
    public function testSetValueWorksAsExpected(): void
    {
        $time = new Time(10.5);
        self::assertSame(10.5, $time->getValue());
    }

    public function testCalculateDecimalTimeWorksAsExpected(): void
    {
        $time = Time::fromTime(6, 42, 23.1337);
        self::assertSame(6.7064260278, $time->getValue());
    }

    public function testGetTimePartsWorksAsExpected(): void
    {
        $time = new Time(6.7064260278);
        self::assertSame(6, $time->getHour());
        self::assertSame(42, $time->getMinute());
        self::assertEqualsWithDelta(23.1337, $time->getDecimalSecond(), 0.0001);
    }

    public function testGetSecondsAsIntegerWorksAsExpected(): void
    {
        $time = new Time(6.7064260278);
        self::assertSame(6, $time->getHour());
        self::assertSame(42, $time->getMinute());
        self::assertSame(23, $time->getSecond());
    }

    public function testGetHourAngleWorksAsExpected(): void
    {
        $time = Time::fromTime(6, 42, 23.1337);
        self::assertEqualsWithDelta(100.596390417, $time->getHourAngle(), 0.0001);
    }

    public function testSetHourAngleWorksAsExpected(): void
    {
        $time = Time::fromHourAngle(100.596390417);
        self::assertSame(6.7064260278, $time->getValue());
    }
}
