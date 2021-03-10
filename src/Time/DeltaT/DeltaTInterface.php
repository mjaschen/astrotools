<?php

declare(strict_types=1);

namespace Astrotools\Time\DeltaT;

/**
 * Interface for Delta T calculation.
 *
 * @author   Marcus Jaschen <mail@marcusjaschen.de>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @see     https://www.marcusjaschen.de/
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
    public function getDeltaT(float $year): float;
}
