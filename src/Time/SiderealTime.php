<?php

declare(strict_types=1);

namespace Astrotools\Time;

use Astrotools\Helper\Time;
use RuntimeException;

/**
 * Sidereal Time utitlity class.
 *
 * @category Astrotools
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @see     https://www.marcusjaschen.de/
 */
class SiderealTime
{
    /**
     * Scale value for BC Math functions.
     *
     * @var int
     */
    public const PRECISION_SCALE = 20;

    /**
     * @var \DateTime
     */
    protected $dateTime;

    /**
     * @param \DateTime $dateTime
     */
    public function __construct(\DateTime $dateTime)
    {
        bcscale(self::PRECISION_SCALE);

        $this->dateTime = $dateTime;
        $this->dateTime->setTimezone(new \DateTimeZone('UTC'));
    }

    /**
     * Calculates the sidereal time for the given timestamp.
     *
     * @return float
     *
     * @throws RuntimeException
     */
    public function getSiderealTime(): float
    {
        $julianDay = JulianDay::fromDateTime($this->dateTime);
        $julianDayString = (string)$julianDay;

        if (!is_numeric($julianDayString)) {
            throw new RuntimeException('Got no numeric-string for Julian Day', 2416833797);
        }

        $T = new JulianCentury($julianDay, new JulianDay(2451545.0));

        $T2 = bcpow((string)$T->getCenturies(), '2');
        $T3 = bcpow((string)$T->getCenturies(), '3');

        $term1 = '280.46061837';
        $term2 = bcmul('360.98564736629', bcsub($julianDayString, '2451545.0'));
        $term3 = bcmul('0.000387933', $T2);
        $term4 = bcdiv($T3, '38710000');

        $result = bcsub(
            bcadd(
                bcadd($term1, $term2),
                $term3
            ),
            $term4
        );

        while (bccomp($result, '0') === -1) {
            $result = bcadd($result, '360');
        }

        while (bccomp($result, '360') >= 1) {
            $result = bcsub($result, '360');
        }

        return Time::fromHourAngle((float) $result)->getValue();
    }

    /**
     * Calculates the local sidereal time for the given timestamp
     * and longitude.
     *
     * @param float $longitude
     *
     * @return float
     */
    public function getLocalSiderealTime(float $longitude): float
    {
        $siderealTime = $this->getSiderealTime();
        $offset = $longitude / 15;

        return $siderealTime + $offset;
    }
}
