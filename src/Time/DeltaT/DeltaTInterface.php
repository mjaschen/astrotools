<?php
/**
 * Interface for Delta T calculation
 *
 * @author    Marcus Jaschen <mjaschen@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license MIT License
 * @link      https://www.marcusjaschen.de/
 */

namespace Astrotools\Time\DeltaT;

/**
 * Interface for Delta T calculation
 *
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://www.marcusjaschen.de/
 */
interface DeltaTInterface
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
     * @return mixed
     */
    public function getDeltaT($year);
}