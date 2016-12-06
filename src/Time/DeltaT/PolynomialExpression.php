<?php
declare(strict_types = 1);

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
    public function getDeltaT(float $year): float
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

    private function getDeltaTBeforeMinus500(float $year): float
    {
        $u = ($year - 1820) / 100;

        return - 20 + 32 * $u ** 2;
    }

    private function getDeltaTBetweenMinus500And500(float $year): float
    {
        $u = $year / 100;

        return 10583.6
               - 1014.41 * $u
               + 33.78311 * $u ** 2
               - 5.952053 * $u ** 3
               - 0.1798452 * $u ** 4
               + 0.022174192 * $u ** 5
               + 0.0090316521 * $u ** 6;
    }

    private function getDeltaTBetween500and1600(float $year): float
    {
        $u = ($year - 1000) / 100;

        return 1574.2
               - 556.01 * $u
               + 71.23472 * $u ** 2
               + 0.319781 * $u ** 3
               - 0.8503463 * $u ** 4
               - 0.005050998 * $u ** 5
               + 0.0083572073 * $u ** 6;
    }

    private function getDeltaTBetween1600and1700(float $year): float
    {
        $u = $year - 1600;

        return 120
               - 0.9808 * $u
               - 0.01532 * $u ** 2
               + $u ** 3 / 7129;
    }

    private function getDeltaTBetween1700and1800(float $year): float
    {
        $u = $year - 1700;

        return 8.83
               + 0.1603 * $u
               - 0.0059285 * $u ** 2
               + 0.00013336 * $u ** 3
               - $u ** 4 / 1174000;
    }

    private function getDeltaTBetween1800and1860(float $year): float
    {
        $u = $year - 1800;

        return 13.72
               - 0.332447 * $u
               + 0.0068612 * $u ** 2
               + 0.0041116 * $u ** 3
               - 0.00037436 * $u ** 4
               + 0.0000121272 * $u ** 5
               - 0.0000001699 * $u ** 6
               + 0.000000000875 * $u ** 7;
    }

    private function getDeltaTBetween1860and1900(float $year): float
    {
        $u = $year - 1860;

        return 7.62
               + 0.5737 * $u
               - 0.251754 * $u ** 2
               + 0.01680668 * $u ** 3
               - 0.0004473624 * $u ** 4
               + $u ** 5 / 233174;
    }

    private function getDeltaTBetween1900and1920(float $year): float
    {
        $u = $year - 1900;

        return - 2.79
               + 1.494119 * $u
               - 0.0598939 * $u ** 2
               + 0.0061966 * $u ** 3
               - 0.000197 * $u ** 4;
    }

    private function getDeltaTBetween1920and1941(float $year): float
    {
        $u = $year - 1920;

        return 21.20
               + 0.84493 * $u
               - 0.076100 * $u ** 2
               + 0.0020936 * $u ** 3;
    }

    private function getDeltaTBetween1941and1961(float $year): float
    {
        $u = $year - 1950;

        return 29.07
               + 0.407 * $u
               - $u ** 2 / 233
               + $u ** 3 / 2547;
    }

    private function getDeltaTBetween1961and1986(float $year): float
    {
        $u = $year - 1975;

        return 45.45
               + 1.067 * $u
               - $u ** 2 / 260
               - $u ** 3 / 718;
    }

    private function getDeltaTBetween1986and2005(float $year): float
    {
        $u = $year - 2000;

        return 63.86
               + 0.3345 * $u
               - 0.060374 * $u ** 2
               + 0.0017275 * $u ** 3
               + 0.000651814 * $u ** 4
               + 0.00002373599 * $u ** 5;
    }

    private function getDeltaTBetween2005and2050(float $year): float
    {
        $u = $year - 2000;

        return 62.92
               + 0.32217 * $u
               + 0.005589 * $u ** 2;
    }

    private function getDeltaTBetween2050and2150(float $year): float
    {
        return - 20
               + 32 * (($year - 1820) / 100) * (($year - 1820) / 100)
               - 0.5628 * (2150 - $year);
    }

    private function getDeltaTAfter2150(float $year): float
    {
        $u = ($year - 1820) / 100;

        return - 20
               + 32 * $u ** 2;
    }
}
