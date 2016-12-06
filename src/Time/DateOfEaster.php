<?php
/**
 * Date of Easter calculation
 *
 * @category  Astrotools
 * @package   Time
 * @author    Marcus Jaschen <mjaschen@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license MIT License
 * @link      https://www.marcusjaschen.de/
 */

namespace Astrotools\Time;

/**
 * Date of Easter calculation
 *
 * @category Astrotools
 * @package  Time
 * @author   Marcus Jaschen <mjaschen@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://www.marcusjaschen.de/
 */
class DateOfEaster
{
    /**
     * @var \DateTime
     */
    protected $dateOfEaster;

    /**
     * @param $year
     */
    public function __construct($year)
    {
        $this->dateOfEaster = $this->calculateDateOfEaster($year);
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->dateOfEaster;
    }

    /**
     * Actual calculation of the "Date of Easter"
     *
     * @param int $year
     *
     * @return \DateTime
     */
    protected function calculateDateOfEaster($year)
    {
        if ($year >= 1583) {
            return $this->calculateGregorianDateOfEaster($year);
        }

        return $this->calculateJulianDateOfEaster($year);
    }

    /**
     * Calculation of the Gregorian Date of Easter
     *
     * @param int $year
     *
     * @return \DateTime
     */
    protected function calculateGregorianDateOfEaster($year)
    {
        $a = $year % 19;
        $b = $this->intDiv($year, 100);
        $c = $year % 100;
        $d = $this->intDiv($b, 4);
        $e = $b % 4;
        $f = $this->intDiv($b + 8, 25);
        $g = $this->intDiv($b - $f + 1, 3);
        $h = (19 * $a + $b - $d - $g + 15) % 30;
        $i = $this->intDiv($c, 4);
        $k = $c % 4;
        $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
        $m = $this->intDiv($a + 11 * $h + 22 * $l, 451);
        $n = $this->intDiv($h + $l - 7 * $m + 114, 31);
        $p = ($h + $l - 7 * $m + 114) % 31;

        return new \DateTime(sprintf('%04d-%02d-%02d', $year, $n, $p + 1), new \DateTimeZone('UTC'));
    }

    /**
     * Calculation of the Julian Date of Easter
     *
     * @param int $year
     *
     * @return \DateTime
     */
    protected function calculateJulianDateOfEaster($year)
    {
        $a = $year % 4;
        $b = $year % 7;
        $c = $year % 19;
        $d = (19 * $c + 15) % 30;
        $e = (2 * $a + 4 * $b - $d + 34) % 7;
        $f = $this->intDiv($d + $e + 114, 31);
        $g = ($d + $e + 114) % 31;

        return new \DateTime(sprintf('%04d-%02d-%02d', $year, $f, $g + 1), new \DateTimeZone('UTC'));
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
        return (int) floor($numerator / $denominator);
    }
}
