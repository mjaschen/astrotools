<?php
/**
 * Test cases for SiderealTime class
 *
 * PHP version 5.4
 *
 * @category  Astrotools
 * @package   Test
 * @author    Marcus Jaschen <mjaschen@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license MIT License
 * @link      https://www.marcusjaschen.de/
 */

/**
 * Test cases for SiderealTime class
 *
 * @category Astrotools
 * @package  Test
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://www.marcusjaschen.de/
 */
class SiderealTimeTest extends PHPUnit_Framework_TestCase
{
    public function testGetSiderealTimeAtTime0WorksAsExpected()
    {
        $dt = new \DateTime('2007-12-25 00:00:00', new \DateTimeZone('UTC'));
        $st = new \Astrotools\Time\SiderealTime($dt);

        // 06:12:31.17
        $this->assertEquals(6.2086583333, $st->getSiderealTime(), '', 0.001);
    }

    public function testGetSiderealTimeAtTime20WorksAsExpected()
    {
        $dt = new \DateTime('2007-12-25 20:00:00', new \DateTimeZone('UTC'));
        $st = new \Astrotools\Time\SiderealTime($dt);

        // 02:15:48.30
        $this->assertEquals(2.2634161794, $st->getSiderealTime(), '', 0.001);
    }

    public function testGetSiderealTimeInYear1987WorksAsExpected()
    {
        $dt = new \DateTime('1987-04-10 19:21:00', new \DateTimeZone('UTC'));
        $st = new \Astrotools\Time\SiderealTime($dt);

        // 13:10:46.3668
        $this->assertEquals(8.58252489, $st->getSiderealTime(), '', 0.001);
    }

    public function testGetLocalSiderealTimeWorksAsExpected()
    {
        $dt = new \DateTime('2007-12-25 20:00:00', new \DateTimeZone('UTC'));
        $st = new \Astrotools\Time\SiderealTime($dt);

        // 03:09:48.30
        $this->assertEquals(3.1634161794, $st->getLocalSiderealTime(13.5), '', 0.001);

    }
}
