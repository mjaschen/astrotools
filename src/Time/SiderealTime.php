<?php
/**
 * Sidereal Time utitlity class
 *
 * PHP version 5.4
 *
 * @category  Astrotools
 * @package   Time
 * @author    Marcus Jaschen <mjaschen@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license MIT License
 * @link      https://www.marcusjaschen.de/
 */

namespace Astrotools\Time;

use Astrotools\Helper\Time;

/**
 * Sidereal Time utitlity class
 *
 * @category Astrotools
 * @package  Time
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://www.marcusjaschen.de/
 */
class SiderealTime
{
    /**
     * Scale value for BC Math functions
     */
    const PRECISION_SCALE = 20;

    /**
     * @var \DateTime
     */
    protected $dateTime;

    /**
     * @param \DateTime $dateTime
     */
    public function __construct(\DateTime $dateTime)
    {
        bcscale(static::PRECISION_SCALE);

        $this->dateTime = $dateTime;
        $this->dateTime->setTimezone(new \DateTimeZone('UTC'));
    }

    /**
     * Calculates the sidereal time for the given timestamp.
     *
     * @return float
     */
    public function getSiderealTime()
    {
        $julianDay = new JulianDay($this->dateTime);

        $T = bcdiv(bcsub(strval($julianDay), '2451545.0'), '36525');

        $T2 = bcpow($T, '2');
        $T3 = bcpow($T, '3');

        $term1 = '280.46061837';
        $term2 = bcmul('360.98564736629', bcsub(strval($julianDay), '2451545.0'));
        $term3 = bcmul('0.000387933', $T2);
        $term4 = bcdiv($T3, '38710000');

        $result = bcsub(
            bcadd(
                bcadd($term1, $term2),
                $term3
            ),
            $term4
        );

        while (bccomp($result, 0) == - 1) {
            $result = bcadd($result, '360');
        }

        while (bccomp($result, '360') >= 1) {
            $result = bcsub($result, '360');
        }

        $st = new Time();
        $st->setHourAngle(floatval($result));

        return $st->getValue();
    }

    /**
     * Calculates the local sidereal time for the given timestamp
     * and longitude.
     *
     * @param float $longitude
     *
     * @return float
     */
    public function getLocalSiderealTime($longitude)
    {
        $st     = $this->getSiderealTime();
        $offset = $longitude / 15;

        return $st + $offset;
    }
}
