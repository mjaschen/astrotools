<?php
/**
 * Test cases for Time class
 *
 * @category  Astrotools
 * @package   Test
 * @author    Marcus Jaschen <mjaschen@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license MIT License
 * @link      https://www.marcusjaschen.de/
 */

use Astrotools\Helper\Time;

/**
 * Test cases for Time class
 *
 * @category Astrotools
 * @package  Test
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://www.marcusjaschen.de/
 */
class TimeTest extends PHPUnit_Framework_TestCase
{
    public function testSetValueWorksAsExpected()
    {
        $time = new Time();
        $time->setValue(10.5);
        $this->assertEquals(10.5, $time->getValue());
    }

    public function testCalculateDecimalTimeWorksAsExpected()
    {
        $time = new Time(6, 42, 23.1337);
        $this->assertEquals(6.7064260278, $time->getValue());
    }

    public function testGetTimePartsWorksAsExpected()
    {
        $time = new Time(6.7064260278);
        $this->assertEquals(6, $time->getHour());
        $this->assertEquals(42, $time->getMinute());
        $this->assertEquals(23.1337, $time->getSecond(), '', 0.0001);
    }

    public function testGetSecondsAsIntegerWorksAsExpected()
    {
        $time = new Time(6.7064260278);
        $this->assertEquals(6, $time->getHour());
        $this->assertEquals(42, $time->getMinute());
        $this->assertEquals(23, $time->getSecond(true));
    }

    public function testGetHourAngleWorksAsExpected()
    {
        $time = new Time(6, 42, 23.1337);
        $this->assertEquals(100.596390417, $time->getHourAngle(), '', 0.0001);
    }

    public function testSetHourAngleWorksAsExpected()
    {
        $time = new Time();
        $time->setHourAngle(100.596390417);
        $this->assertEquals(6.7064260278, $time->getValue());
    }
}
