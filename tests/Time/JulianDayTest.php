<?php
declare(strict_types = 1);

/**
 * Test for Julian Day class
 *
 * @category  Astrotools
 * @package   Test
 * @author    Marcus Jaschen <mjaschen@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license MIT License
 * @link      https://www.marcusjaschen.de/
 */

/**
 * Test for Julian Day class
 *
 * @category Astrotools
 * @package  Test
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://www.marcusjaschen.de/
 */
class JulianDayTest extends PHPUnit_Framework_TestCase
{
    public function testConversionDateTimeToJulianDayWorksAsExpected()
    {
        $dt = new \DateTime('2015-02-25 11:01:36', new \DateTimeZone('UTC'));
        $jd = new \Astrotools\Time\JulianDay($dt);

        $this->assertEquals(2457078.95944, $jd->getValue(), '', 0.0001);
    }

    public function testConversionDateTimeToJulianDayForReferenceDateInYear2000WorksAsExpected()
    {
        $dt = new \DateTime('2000-01-01 12:00:00', new \DateTimeZone('UTC'));
        $jd = new \Astrotools\Time\JulianDay($dt);

        $this->assertEquals(2451545.0, $jd->getValue(), '', 0.0001);
    }

    public function testConversionDateTimeToJulianDayWithLocalTimezoneWorksAsExpected()
    {
        $dt = new \DateTime('2015-02-25 12:01:36', new \DateTimeZone('Europe/Berlin'));
        $jd = new \Astrotools\Time\JulianDay($dt);

        $this->assertEquals(2457078.95944, $jd->getValue(), '', 0.0001);
    }

    public function testConversionDateTimeToJulianDayBeforeGregorianCalendarBeganWorksAsExpected()
    {
        $dt = new \DateTime('0333-01-27 12:00:00', new \DateTimeZone('UTC'));
        $jd = new \Astrotools\Time\JulianDay($dt);

        $this->assertEquals(1842713.0, $jd->getValue(), '', 0.0001);
    }

    public function testConversionDateTimeToJulianDayAtGregorianCalendarLowerBoundWorksAsExpected()
    {
        $dt = new \DateTime('1582-10-04 24:00:00', new \DateTimeZone('UTC'));
        $jd = new \Astrotools\Time\JulianDay($dt);

        $this->assertEquals(2299160.5, $jd->getValue(), '', 0.0001);
    }

    public function testConversionDateTimeToJulianDayAtGregorianCalendarUpperBoundWorksAsExpected()
    {
        $dt = new \DateTime('1582-10-15 00:00:00', new \DateTimeZone('UTC'));
        $jd = new \Astrotools\Time\JulianDay($dt);

        $this->assertEquals(2299160.5, $jd->getValue(), '', 0.0001);
    }

    public function testConversionJulianDayToCalenderWorksAsExpected()
    {
        $jd = new \Astrotools\Time\JulianDay();
        $jd->setValue(2457078.95944);


        $dt = new \DateTime('2015-02-25 11:01:36', new \DateTimeZone('UTC'));

        // allow 1 second offset until we've implemented arbitary precision calculations...
        $this->assertEquals($dt, $jd->getDateTime(), '', 1);
    }

    public function testConversionJulianDayToCalenderForReferenceDateInYear2000WorksAsExpected()
    {
        $jd = new \Astrotools\Time\JulianDay();
        $jd->setValue(2451545.0);


        $dt = new \DateTime('2000-01-01 12:00:00', new \DateTimeZone('UTC'));

        // allow 1 second offset until we've implemented arbitary precision calculations...
        $this->assertEquals($dt, $jd->getDateTime(), '', 1);
    }

    public function testConversionsJulianDayToCalendarBeforeGregorianCalendarBeganWorksAsExpected()
    {
        $jd = new \Astrotools\Time\JulianDay();
        $jd->setValue(1842713.0);


        $dt = new \DateTime('0333-01-27 12:00:00', new \DateTimeZone('UTC'));

        // allow 1 second offset until we've implemented arbitary precision calculations...
        $this->assertEquals($dt, $jd->getDateTime(), '', 1);
    }

    public function testConversionsJulianDayToCalendarAtGregorianCalendarLowerBoundWorksAsExpected()
    {
        $jd = new \Astrotools\Time\JulianDay();
        $jd->setValue(2299160.0);


        $dt = new \DateTime('1582-10-04 12:00:00', new \DateTimeZone('UTC'));

        // allow 1 second offset until we've implemented arbitary precision calculations...
        $this->assertEquals($dt, $jd->getDateTime(), '', 1);
    }

    public function testConversionsJulianDayToCalendarAtGregorianCalendarUpperBoundWorksAsExpected()
    {
        $jd = new \Astrotools\Time\JulianDay();
        $jd->setValue(2299160.5);


        $dt = new \DateTime('1582-10-15 00:00:00', new \DateTimeZone('UTC'));

        // allow 1 second offset until we've implemented arbitary precision calculations...
        $this->assertEquals($dt, $jd->getDateTime(), '', 1);
    }

    public function testConvertObjectToStringWorksAsExpected()
    {
        $jd = new \Astrotools\Time\JulianDay();
        $jd->setValue(2299160.5);

        $this->assertEquals('2299160.5', strval($jd));
    }

    public function testSetDateTimeWorksAsExpected()
    {
        $dt = new \DateTime('2015-02-25 11:01:36', new \DateTimeZone('UTC'));
        $jd = new \Astrotools\Time\JulianDay();
        $jd->setDateTime($dt);

        $this->assertEquals(2457078.95944, $jd->getValue(), '', 0.0001);
    }

    public function testToStringWorksAsExpected()
    {
        $dt = new \DateTime('2015-02-25 11:01:36', new \DateTimeZone('UTC'));
        $jd = new \Astrotools\Time\JulianDay();
        $jd->setDateTime($dt);

        $this->assertEquals('2457078.9594444', (string) $jd);
    }

    public function testSetValueWorksAsExpected()
    {
        $jd = new \Astrotools\Time\JulianDay();
        $jd->setValue(2455987.315970);
        $expected = new \DateTime('2012-02-29 19:34:59.8', new \DateTimeZone('UTC'));
        $this->assertEquals($expected, $jd->getDateTime());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetInvalidDateThrowsException()
    {
        $dt = new \DateTime('1582-10-05 12:00:00', new \DateTimeZone('UTC'));
        $jd = new \Astrotools\Time\JulianDay($dt);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGetUninitializedValueThrowsException()
    {
        $jd = new \Astrotools\Time\JulianDay();
        $value = $jd->getValue();
    }
}
