<?php
/**
 * Delta T calculation by polynomial epxressions
 *
 * @author    Marcus Jaschen <mjaschen@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license MIT License
 * @link      https://www.marcusjaschen.de/
 */

namespace Astrotools\Time\DeltaT;

/**
 * Delta T calculation by polynomial epxressions
 *
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://www.marcusjaschen.de/
 */
class PolynomialExpression implements DeltaTInterface
{
    /**
     * Return the value of Delta T for the given decimal year.
     *
     * A decimal year is a float value. It's accurate enough to use the month and
     * year parts of a date to calulcalte the decimal year:
     *
     * decimalYear = year + (month - 0.5) / 12
     *
     * @param float $year
     *
     * @return float
     */
    public function getDeltaT($year)
    {
        if ($year > 2150) {
            return $this->getDeltaTAfter2150($year);
        }

        if ($year > 2050) {
            return $this->getDeltaTBetween2050and2150($year);
        }

        if ($year > 2005) {
            return $this->getDeltaTBetween2005and2050($year);
        }

        if ($year > 1986) {
            return $this->getDeltaTBetween1986and2005($year);
        }

        if ($year > 1961) {
            return $this->getDeltaTBetween1961and1986($year);
        }

        if ($year > 1941) {
            return $this->getDeltaTBetween1941and1961($year);
        }

        if ($year > 1920) {
            return $this->getDeltaTBetween1920and1941($year);
        }

        if ($year > 1900) {
            return $this->getDeltaTBetween1900and1920($year);
        }

        if ($year > 1860) {
            return $this->getDeltaTBetween1860and1900($year);
        }

        if ($year > 1800) {
            return $this->getDeltaTBetween1800and1860($year);
        }

        if ($year > 1700) {
            return $this->getDeltaTBetween1700and1800($year);
        }

        if ($year > 1600) {
            return $this->getDeltaTBetween1600and1700($year);
        }

        if ($year > 500) {
            return $this->getDeltaTBetween500and1600($year);
        }

        if ($year > - 500) {
            return $this->getDeltaTBetweenMinus500And500($year);
        }

        return $this->getDeltaTBeforeMinus500($year);
    }

    private function getDeltaTBeforeMinus500($year)
    {
        $u = ($year - 1820) / 100;

        return - 20 + 32 * $u * $u;
    }

    private function getDeltaTBetweenMinus500And500($year)
    {
        $u = $year / 100;

        return 10583.6
               - 1014.41 * $u
               + 33.78311 * $u * $u
               - 5.952053 * $u * $u * $u
               - 0.1798452 * $u * $u * $u * $u
               + 0.022174192 * $u * $u * $u * $u * $u
               + 0.0090316521 * $u * $u * $u * $u * $u * $u;
    }

    private function getDeltaTBetween500and1600($year)
    {
        $u = ($year - 1000) / 100;

        return 1574.2
               - 556.01 * $u
               + 71.23472 * $u * $u
               + 0.319781 * $u * $u * $u
               - 0.8503463 * $u * $u * $u * $u
               - 0.005050998 * $u * $u * $u * $u * $u
               + 0.0083572073 * $u * $u * $u * $u * $u * $u;
    }

    private function getDeltaTBetween1600and1700($year)
    {
        $u = $year - 1600;

        return 120
               - 0.9808 * $u
               - 0.01532 * $u * $u
               + $u * $u * $u / 7129;
    }

    private function getDeltaTBetween1700and1800($year)
    {
        $u = $year - 1700;

        return 8.83
               + 0.1603 * $u
               - 0.0059285 * $u * $u
               + 0.00013336 * $u * $u * $u
               - $u * $u * $u * $u / 1174000;
    }

    private function getDeltaTBetween1800and1860($year)
    {
        $u = $year - 1800;

        return 13.72
               - 0.332447 * $u
               + 0.0068612 * $u * $u
               + 0.0041116 * $u * $u * $u
               - 0.00037436 * $u * $u * $u * $u
               + 0.0000121272 * $u * $u * $u * $u * $u
               - 0.0000001699 * $u * $u * $u * $u * $u * $u
               + 0.000000000875 * $u * $u * $u * $u * $u * $u * $u;
    }

    private function getDeltaTBetween1860and1900($year)
    {
        $u = $year - 1860;

        return 7.62
               + 0.5737 * $u
               - 0.251754 * $u * $u
               + 0.01680668 * $u * $u * $u
               - 0.0004473624 * $u * $u * $u * $u
               + $u * $u * $u * $u * $u / 233174;
    }

    private function getDeltaTBetween1900and1920($year)
    {
        $u = $year - 1900;

        return - 2.79
               + 1.494119 * $u
               - 0.0598939 * $u * $u
               + 0.0061966 * $u * $u * $u
               - 0.000197 * $u * $u * $u * $u;
    }

    private function getDeltaTBetween1920and1941($year)
    {
        $u = $year - 1920;

        return 21.20
               + 0.84493 * $u
               - 0.076100 * $u * $u
               + 0.0020936 * $u * $u * $u;
    }

    private function getDeltaTBetween1941and1961($year)
    {
        $u = $year - 1950;

        return 29.07
               + 0.407 * $u
               - $u * $u / 233
               + $u * $u * $u / 2547;
    }

    private function getDeltaTBetween1961and1986($year)
    {
        $u = $year - 1975;

        return 45.45
               + 1.067 * $u
               - $u * $u / 260
               - $u * $u * $u / 718;
    }

    private function getDeltaTBetween1986and2005($year)
    {
        $u = $year - 2000;

        return 63.86
               + 0.3345 * $u
               - 0.060374 * $u * $u
               + 0.0017275 * $u * $u * $u
               + 0.000651814 * $u * $u * $u * $u
               + 0.00002373599 * $u * $u * $u * $u * $u;
    }

    private function getDeltaTBetween2005and2050($year)
    {
        $u = $year - 2000;

        return 62.92
               + 0.32217 * $u
               + 0.005589 * $u * $u;
    }

    private function getDeltaTBetween2050and2150($year)
    {
        return - 20
               + 32 * (($year - 1820) / 100) * (($year - 1820) / 100)
               - 0.5628 * (2150 - $year);
    }

    private function getDeltaTAfter2150($year)
    {
        $u = ($year - 1820) / 100;

        return - 20
               + 32 * $u * $u;
    }
}