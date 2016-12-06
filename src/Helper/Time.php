<?php
/**
 * Time utility class
 *
 * @category  Astrotools
 * @package   Time
 * @author    Marcus Jaschen <mjaschen@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license MIT License
 * @link      https://www.marcusjaschen.de/
 */

namespace Astrotools\Helper;

/**
 * Time utility class
 *
 * @category Astrotools
 * @package  Time
 * @author   Marcus Jaschen <mjaschen@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     https://www.marcusjaschen.de/
 */
class Time
{
    /**
     * @var float
     */
    protected $value;

    /**
     * @param float $hours
     * @param float $minutes
     * @param float $seconds
     */
    public function __construct(float $hours = 0.0, float $minutes = 0.0, float $seconds = 0.0)
    {
        $this->calculateValue($hours, $minutes, $seconds);
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value)
    {
        $this->value = $value;
    }

    /**
     * Returns the hour angle of the current time (hour value multiplied by 15)
     *
     * @return float
     */
    public function getHourAngle(): float
    {
        return $this->value * 15;
    }

    /**
     * Sets the time given as hour angle
     *
     * @param float $hourAngle
     */
    public function setHourAngle(float $hourAngle)
    {
        $this->value = $hourAngle / 15;
    }

    /**
     * Returns the full hours
     *
     * @return int
     */
    public function getHour(): int
    {
        return (int) $this->value;
    }

    /**
     * Returns the full minutes
     *
     * @return int
     */
    public function getMinute(): int
    {
        return (int) (($this->value - $this->getHour()) * 60);
    }

    /**
     * Returns the seconds as integer.
     *
     * @return int
     */
    public function getSecond(): int
    {
        return (int) $this->getDecimalSecond();
    }

    /**
     * Returns the seconds as float number.
     *
     * @return float
     */
    public function getDecimalSecond(): float
    {
        return (($this->value - $this->getHour()) * 60 - $this->getMinute()) * 60;
    }

    /**
     * Calculate decimal hour value
     *
     * @param float $hours
     * @param float $minutes
     * @param float $seconds
     */
    protected function calculateValue(float $hours, float $minutes, float $seconds)
    {
        $this->value = $hours + $minutes / 60 + $seconds / 3600;
    }
}
