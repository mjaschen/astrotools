<?php

declare(strict_types=1);

namespace Astrotools\Time;

use Astrotools\Helper\Time;
use DateTime;
use InvalidArgumentException;
use RuntimeException;

/**
 * Representation of a Julian Day.
 *
 * @category Astrotools
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @see     https://www.marcusjaschen.de/
 */
class JulianDay
{
    /**
     * Scale value for BC Math functions.
     *
     * @var int
     */
    public const PRECISION_SCALE = 20;

    /**
     * @var float
     */
    protected $value;

    /**
     * @param float $value
     */
    public function __construct(float $value)
    {
        bcscale(self::PRECISION_SCALE);
        $this->value = $value;
    }

    /**
     * @param DateTime $dateTime
     * @return JulianDay
     */
    public static function fromDateTime(DateTime $dateTime): self
    {
        bcscale(self::PRECISION_SCALE);

        return new self(self::dateTimeToJulianDay($dateTime));
    }

    /**
     * @return float
     * @throws RuntimeException
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Returns the DateTime object for the current Julian Day.
     *
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->julianDayToDatetime($this->value);
    }

    /**
     * String representation of instance.
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->getValue();
    }

    /**
     * Conversion from DateTime object to Julian Day.
     *
     * @param DateTime $dateTime
     *
     * @return float
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    private static function dateTimeToJulianDay(DateTime $dateTime): float
    {
        $dt = $dateTime;
        $dt->setTimezone(new \DateTimeZone('UTC'));

        $year = $dt->format('Y');
        $month = $dt->format('m');
        $day = $dt->format('d');
        $hour = $dt->format('H');
        $minute = $dt->format('i');
        $second = $dt->format('s');

        // the following checks and type-casts can be removed once we drop PHP 7.x
        if (!is_numeric($year) || !is_numeric($month) || !is_numeric($day)) {
            throw new RuntimeException('Extracting date values failed', 7090776005);
        }

        if (!is_numeric($hour) || !is_numeric($minute) || !is_numeric($second)) {
            throw new RuntimeException('Extracting time values failed', 6313957488);
        }

        if (bccomp($month, '2') <= 0) {
            $year = bcsub($year, '1');
            $month = bcadd($month, '12');
        }

        $hour = bcdiv($hour, '24');
        $hour = bcadd($hour, bcdiv($minute, '1440'));
        $hour = bcadd($hour, bcdiv($second, '86400'));

        $dtGregorianCalendarUpper = new DateTime('1582-10-15 00:00:00', new \DateTimeZone('UTC'));
        $dtGregorianCalendarLower = new DateTime('1582-10-04 24:00:00', new \DateTimeZone('UTC'));

        if ($dt > $dtGregorianCalendarLower && $dt < $dtGregorianCalendarUpper) {
            throw new InvalidArgumentException(
                'DateTime is between 1582-10-04 24:00:00 and 1582-10-15 00:00:00 and therefore cannot be used.'
            );
        }

        $B = '0';

        if ($dt >= $dtGregorianCalendarUpper) {
            $A = bcdiv($year, '100', 0);
            $B = bcadd(bcsub('2', $A), bcdiv($A, '4', 0));
        }

        $part1 = bcmul('365.25', bcadd($year, '4716'), 0);
        $part2 = bcmul('30.6001', bcadd($month, '1'), 0);
        $part3 = bcsub(bcadd(bcadd($day, $hour), $B), '1524.5');

        $result = bcadd(bcadd($part1, $part2), $part3);

        return (float)$result;
    }

    /**
     * Create the DateTime object for the given Julian Day.
     *
     * @see http://www.tondering.dk/claus/cal/julperiod.php
     *
     * @param float $julianDay
     *
     * @return DateTime
     */
    private function julianDayToDatetime(float $julianDay): DateTime
    {
        $J = $julianDay + 0.5;

        $Z = (int)$J;
        $F = $J - $Z;

        $A = $Z;
        if ($Z >= 2299161) {
            $a = $this->intDiv($Z - 1867216.25, 36524.25);
            $A = $Z + 1 + $a - $this->intDiv($a, 4);
        }

        $B = $A + 1524;
        $C = $this->intDiv($B - 122.1, 365.25);
        $D = (int)(365.25 * $C);
        $E = $this->intDiv($B - $D, 30.6001);

        $day = $B - $D - (int)(30.6001 * $E) + $F;
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

        $decimalDayTime = $day - (int)$day;

        $time = new Time(24 * $decimalDayTime);
        $hour = $time->getHour();
        $minute = $time->getMinute();
        $second = $time->getDecimalSecond();

        $dateTime = new DateTime(
            sprintf('%04d-%02d-%02d %02d:%02d:%02.1f', $year, $month, $day, $hour, $minute, $second),
            new \DateTimeZone('UTC')
        );

        return $dateTime;
    }

    /**
     * Helper method for integer division.
     *
     * @param float $numerator
     * @param float $denominator
     *
     * @return int
     */
    private function intDiv(float $numerator, float $denominator): int
    {
        return (int)floor($numerator / $denominator);
    }
}
