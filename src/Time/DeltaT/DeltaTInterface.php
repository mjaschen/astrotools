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
     * @param float $year
     *
     * @return float
     */
    public function getDeltaT($year);
}