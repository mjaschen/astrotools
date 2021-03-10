<?php

declare(strict_types=1);

namespace Astrotools\Tests\Time;

/**
 * Test for Julian Day class.
 *
 * @category Astrotools
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @see     https://www.marcusjaschen.de/
 */
class JulianDayTest extends \PHPUnit\Framework\TestCase
{
    public function testConversionDateTimeToJulianDayWorksAsExpected(): void
    {
        $dt = new \DateTime('2015-02-25 11:01:36', new \DateTimeZone('UTC'));
        $jd = \Astrotools\Time\JulianDay::fromDateTime($dt);

        // 2457078.95944
        self::assertEqualsWithDelta(2457078.95944, $jd->getValue(), 0.0001);
    }

    public function testConversionDateTimeToJulianDayForReferenceDateInYear2000WorksAsExpected(): void
    {
        $dt = new \DateTime('2000-01-01 12:00:00', new \DateTimeZone('UTC'));
        $jd = \Astrotools\Time\JulianDay::fromDateTime($dt);

        self::assertEqualsWithDelta(2451545.0, $jd->getValue(), 0.0001);
    }

    public function testConversionDateTimeToJulianDayWithLocalTimezoneWorksAsExpected(): void
    {
        $dt = new \DateTime('2015-02-25 12:01:36', new \DateTimeZone('Europe/Berlin'));
        $jd = \Astrotools\Time\JulianDay::fromDateTime($dt);

        self::assertEqualsWithDelta(2457078.95944, $jd->getValue(), 0.0001);
    }

    public function testConversionDateTimeToJulianDayBeforeGregorianCalendarBeganWorksAsExpected(): void
    {
        $dt = new \DateTime('0333-01-27 12:00:00', new \DateTimeZone('UTC'));
        $jd = \Astrotools\Time\JulianDay::fromDateTime($dt);

        self::assertEqualsWithDelta(1842713.0, $jd->getValue(), 0.0001);
    }

    public function testConversionDateTimeToJulianDayAtGregorianCalendarLowerBoundWorksAsExpected(): void
    {
        $dt = new \DateTime('1582-10-04 24:00:00', new \DateTimeZone('UTC'));
        $jd = \Astrotools\Time\JulianDay::fromDateTime($dt);

        self::assertEqualsWithDelta(2299160.5, $jd->getValue(), 0.0001);
    }

    public function testConversionDateTimeToJulianDayAtGregorianCalendarUpperBoundWorksAsExpected(): void
    {
        $dt = new \DateTime('1582-10-15 00:00:00', new \DateTimeZone('UTC'));
        $jd = \Astrotools\Time\JulianDay::fromDateTime($dt);

        self::assertEqualsWithDelta(2299160.5, $jd->getValue(), 0.0001);
    }

    public function testConversionJulianDayToCalenderWorksAsExpected(): void
    {
        $jd = new \Astrotools\Time\JulianDay(2457078.95944);

        $dt = new \DateTime('2015-02-25 11:01:36', new \DateTimeZone('UTC'));

        // allow 1 second offset until we've implemented arbitary precision calculations...
        self::assertEqualsWithDelta($dt, $jd->getDateTime(), 1);
    }

    public function testConversionJulianDayToCalenderForReferenceDateInYear2000WorksAsExpected(): void
    {
        $jd = new \Astrotools\Time\JulianDay(2451545.0);

        $dt = new \DateTime('2000-01-01 12:00:00', new \DateTimeZone('UTC'));

        // allow 1 second offset until we've implemented arbitary precision calculations...
        self::assertEqualsWithDelta($dt, $jd->getDateTime(), 1);
    }

    public function testConversionsJulianDayToCalendarBeforeGregorianCalendarBeganWorksAsExpected(): void
    {
        $jd = new \Astrotools\Time\JulianDay(1842713.0);

        $dt = new \DateTime('0333-01-27 12:00:00', new \DateTimeZone('UTC'));

        // allow 1 second offset until we've implemented arbitary precision calculations...
        self::assertEqualsWithDelta($dt, $jd->getDateTime(), 1);
    }

    public function testConversionsJulianDayToCalendarAtGregorianCalendarLowerBoundWorksAsExpected(): void
    {
        $jd = new \Astrotools\Time\JulianDay(2299160.0);

        $dt = new \DateTime('1582-10-04 12:00:00', new \DateTimeZone('UTC'));

        // allow 1 second offset until we've implemented arbitary precision calculations...
        self::assertEqualsWithDelta($dt, $jd->getDateTime(), 1);
    }

    public function testConversionsJulianDayToCalendarAtGregorianCalendarUpperBoundWorksAsExpected(): void
    {
        $jd = new \Astrotools\Time\JulianDay(2299160.5);

        $dt = new \DateTime('1582-10-15 00:00:00', new \DateTimeZone('UTC'));

        // allow 1 second offset until we've implemented arbitary precision calculations...
        self::assertEqualsWithDelta($dt, $jd->getDateTime(), 1);
    }

    public function testConvertObjectToStringWorksAsExpected(): void
    {
        $jd = new \Astrotools\Time\JulianDay(2299160.5);

        self::assertSame('2299160.5', (string)$jd);
    }

    public function testSetDateTimeWorksAsExpected(): void
    {
        $dt = new \DateTime('2015-02-25 11:01:36', new \DateTimeZone('UTC'));
        $jd = \Astrotools\Time\JulianDay::fromDateTime($dt);

        self::assertEqualsWithDelta(2457078.95944, $jd->getValue(), 0.0001);
    }

    public function testToStringWorksAsExpected(): void
    {
        $dt = new \DateTime('2015-02-25 11:01:36', new \DateTimeZone('UTC'));
        $jd = \Astrotools\Time\JulianDay::fromDateTime($dt);

        self::assertSame('2457078.9594444', (string)$jd);
    }

    public function testSetValueWorksAsExpected(): void
    {
        $jd = new \Astrotools\Time\JulianDay(2455987.315970);
        $expected = new \DateTime('2012-02-29 19:34:59.8', new \DateTimeZone('UTC'));

        self::assertEquals($expected, $jd->getDateTime());
    }

    public function testSetInvalidDateThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $dt = new \DateTime('1582-10-05 12:00:00', new \DateTimeZone('UTC'));
        $jd = \Astrotools\Time\JulianDay::fromDateTime($dt);
    }
}
