<?php

declare(strict_types=1);

namespace Astrotools\Tests\Time;

/**
 * Test cases for DateOfEaster class.
 *
 * @category Astrotools
 * @author   Marcus Jaschen <mjaschen@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @see     https://www.marcusjaschen.de/
 */
class DateOfEasterTest extends \PHPUnit\Framework\TestCase
{
    public function testDateOfEasterCalculationForYear1991WorksAsExpected(): void
    {
        $doe = new \Astrotools\Time\DateOfEaster(1991);

        $expected = new \DateTime('1991-03-31', new \DateTimeZone('UTC'));

        self::assertEquals($expected, $doe->getDate());
    }

    public function testDateOfEasterCalculationForYear1992WorksAsExpected(): void
    {
        $doe = new \Astrotools\Time\DateOfEaster(1992);

        $expected = new \DateTime('1992-04-19', new \DateTimeZone('UTC'));

        self::assertEquals($expected, $doe->getDate());
    }

    public function testDateOfEasterCalculationForYear1993WorksAsExpected(): void
    {
        $doe = new \Astrotools\Time\DateOfEaster(1993);

        $expected = new \DateTime('1993-04-11', new \DateTimeZone('UTC'));

        self::assertEquals($expected, $doe->getDate());
    }

    public function testDateOfEasterCalculationForYear1954WorksAsExpected(): void
    {
        $doe = new \Astrotools\Time\DateOfEaster(1954);

        $expected = new \DateTime('1954-04-18', new \DateTimeZone('UTC'));

        self::assertEquals($expected, $doe->getDate());
    }

    public function testDateOfEasterCalculationForYear2000WorksAsExpected(): void
    {
        $doe = new \Astrotools\Time\DateOfEaster(2000);

        $expected = new \DateTime('2000-04-23', new \DateTimeZone('UTC'));

        self::assertEquals($expected, $doe->getDate());
    }

    public function testDateOfEasterCalculationForYear1818WorksAsExpected(): void
    {
        $doe = new \Astrotools\Time\DateOfEaster(1818);

        $expected = new \DateTime('1818-03-22', new \DateTimeZone('UTC'));

        self::assertEquals($expected, $doe->getDate());
    }

    public function testDateOfEasterCalculationForYear1583WorksAsExpected(): void
    {
        $doe = new \Astrotools\Time\DateOfEaster(1583);

        $expected = new \DateTime('1583-04-10', new \DateTimeZone('UTC'));

        self::assertEquals($expected, $doe->getDate());
    }

    public function testDateOfEasterCalculationForYear179WorksAsExpected(): void
    {
        $doe = new \Astrotools\Time\DateOfEaster(179);

        $expected = new \DateTime('0179-04-12', new \DateTimeZone('UTC'));

        self::assertEquals($expected, $doe->getDate());
    }

    public function testDateOfEasterCalculationForYear711WorksAsExpected(): void
    {
        $doe = new \Astrotools\Time\DateOfEaster(711);

        $expected = new \DateTime('0711-04-12', new \DateTimeZone('UTC'));

        self::assertEquals($expected, $doe->getDate());
    }

    public function testDateOfEasterCalculationForYear1243WorksAsExpected(): void
    {
        $doe = new \Astrotools\Time\DateOfEaster(1243);

        $expected = new \DateTime('1243-04-12', new \DateTimeZone('UTC'));

        self::assertEquals($expected, $doe->getDate());
    }
}
