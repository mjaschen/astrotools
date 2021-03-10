<?php

declare(strict_types=1);

namespace Astrotools\Tests\Time;

/**
 * Test cases for SiderealTime class.
 *
 * @category Astrotools
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @see     https://www.marcusjaschen.de/
 */
class SiderealTimeTest extends \PHPUnit\Framework\TestCase
{
    public function testGetSiderealTimeAtTime0WorksAsExpected(): void
    {
        $dt = new \DateTime('2007-12-25 00:00:00', new \DateTimeZone('UTC'));
        $st = new \Astrotools\Time\SiderealTime($dt);

        // 06:12:31.17
        self::assertEqualsWithDelta(6.2086583333, $st->getSiderealTime(), 0.001);
    }

    public function testGetSiderealTimeAtTime20WorksAsExpected(): void
    {
        $dt = new \DateTime('2007-12-25 20:00:00', new \DateTimeZone('UTC'));
        $st = new \Astrotools\Time\SiderealTime($dt);

        // 02:15:48.30
        self::assertEqualsWithDelta(2.2634161794, $st->getSiderealTime(), 0.001);
    }

    public function testGetSiderealTimeInYear1987WorksAsExpected(): void
    {
        $dt = new \DateTime('1987-04-10 19:21:00', new \DateTimeZone('UTC'));
        $st = new \Astrotools\Time\SiderealTime($dt);

        // 13:10:46.3668
        self::assertEqualsWithDelta(8.58252489, $st->getSiderealTime(), 0.001);
    }

    public function testGetLocalSiderealTimeWorksAsExpected(): void
    {
        $dt = new \DateTime('2007-12-25 20:00:00', new \DateTimeZone('UTC'));
        $st = new \Astrotools\Time\SiderealTime($dt);

        // 03:09:48.30
        self::assertEqualsWithDelta(3.1634161794, $st->getLocalSiderealTime(13.5), 0.001);
    }
}
