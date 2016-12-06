<?php
/**
 * Representation of a Julian Day
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
 * Representation of a Julian Day
 *
 * @category Astrotools
 * @package  Time
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://www.marcusjaschen.de/
 */
class JulianDay
{
    /**
     * Scale value for BC Math functions
     */
    const PRECISION_SCALE = 20;

    /**
     * @var float
     */
    protected $value;

    /**
     * @param \DateTime $dateTime
     */
    public function __construct(\DateTime $dateTime = null)
    {
        bcscale(static::PRECISION_SCALE);

        if ($dateTime instanceof \DateTime) {
            $this->value = $this->dateTimeToJulianDay($dateTime);
        }
    }

    /**
     * @param float $julianDay
     */
    public function setValue($julianDay)
    {
        if (! is_numeric($julianDay)) {
            throw new \InvalidArgumentException("Julian Date must be numeric");
        }

        $this->value = $julianDay;
    }

    /**
     * Reset the current Julian Day to the given DateTime object
     *
     * @param \DateTime $dateTime
     */
    public function setDateTime(\DateTime $dateTime)
    {
        $this->value = $this->dateTimeToJulianDay($dateTime);
    }

    /**
     * @return float
     */
    public function getValue()
    {
        if (is_null($this->value)) {
            throw new \RuntimeException("Julian Day was not set");
        }

        return $this->value;
    }

    /**
     * Returns the DateTime object for the current Julian Day
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->julianDayToDatetime($this->value);
    }

    /**
     * String representation of instance
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }

    /**
     * Conversion from DateTime object to Julian Day
     *
     * @param \DateTime $dateTime
     *
     * @return float
     */
    protected function dateTimeToJulianDay(\DateTime $dateTime)
    {
        $dt = $dateTime;
        $dt->setTimezone(new \DateTimeZone('UTC'));

        $year   = $dt->format('Y');
        $month  = $dt->format('m');
        $day    = $dt->format('d');
        $hour   = $dt->format('H');
        $minute = $dt->format('i');
        $second = $dt->format('s');

        if (bccomp($month, '2') <= 0) {
            $year = bcsub($year, '1');
            $month = bcadd($month, '12');
        }

        $hour = bcdiv($hour, '24');
        $hour = bcadd($hour, bcdiv($minute, '1440'));
        $hour = bcadd($hour, bcdiv($second, '86400'));

        $dtGregorianCalendarUpper = new \DateTime('1582-10-15 00:00:00', new \DateTimeZone('UTC'));
        $dtGregorianCalendarLower = new \DateTime('1582-10-04 24:00:00', new \DateTimeZone('UTC'));

        if ($dt > $dtGregorianCalendarLower && $dt < $dtGregorianCalendarUpper) {
            throw new \InvalidArgumentException(
                "DateTime is between 1582-10-04 24:00:00 and 1582-10-15 00:00:00 and therefore cannot be used."
            );
        }

        $B = '0';

        if ($dt >= $dtGregorianCalendarUpper) {
            $A = bcdiv($year, '100', 0);
            $B = bcadd(bcsub('2', $A), bcdiv($A, '4', 0));
        }

        $part1= bcmul('365.25', bcadd($year, '4716'), 0);
        $part2 = bcmul('30.6001', bcadd($month, '1'), 0);
        $part3 = bcsub(bcadd(bcadd($day, $hour), $B), '1524.5');

        $result = bcadd(bcadd($part1, $part2), $part3);

        return (float) $result;
    }

    /**
     * Create the DateTime object for the given Julian Day
     *
     * @link http://www.tondering.dk/claus/cal/julperiod.php
     *
     * @param float $julianDay
     *
     * @return \DateTime
     */
    protected function julianDayToDatetime($julianDay)
    {
        $J = $julianDay + 0.5;

        $Z = (int) $J;
        $F = $J - $Z;

        $A = $Z;
        if ($Z >= 2299161) {
            $a = $this->intDiv($Z - 1867216.25, 36524.25);
            $A = $Z + 1 + $a - $this->intDiv($a, 4);
        }

        $B = $A + 1524;
        $C = $this->intDiv($B - 122.1, 365.25);
        $D = (int) (365.25 * $C);
        $E = $this->intDiv($B - $D, 30.6001);

        $day = $B - $D - (int) (30.6001 * $E) + $F;
        if ($E < 14) {
            $month = $E - 1;
        } else {
            $month = $E - 13;
        }
        if ($month > 2) {
            $year = $C - 4716;
        } else {
            $year = $C - 4715;
        }

        $decimalDayTime = $day - (int) $day;

        $time = new Time(24 * $decimalDayTime);
        $hour = $time->getHour();
        $minute = $time->getMinute();
        $second = $time->getSecond();

        $dateTime = new \DateTime(
            sprintf('%04d-%02d-%02d %02d:%02d:%02.1f', $year, $month, $day, $hour, $minute, $second),
            new \DateTimeZone('UTC')
        );

        return $dateTime;
    }

    /**
     * Helper method for integer division
     *
     * @param $numerator
     * @param $denominator
     *
     * @return int
     */
    protected function intDiv($numerator, $denominator)
    {
        return intval(floor($numerator / $denominator));
    }
}
