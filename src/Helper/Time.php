<?php
/**
 * Time utility class
 *
 * PHP version 5.5
 *
 * @category  Astrotools
 * @package   Time
 * @author    Marcus Jaschen <mjaschen@gmail.com>
 * @copyright 1999-2015 MTB-News.de
 * @license   http://www.opensource.org/licenses/mit-license MIT License
 * @link      http://www.mtb-news.de/
 */

namespace Astrotools\Helper;

/**
 * Time utility class
 *
 * @category Astrotools
 * @package  Time
 * @author   Marcus Jaschen <mjaschen@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @link     http://www.mtb-news.de/
 */
class Time
{
    /**
     * @var float
     */
    protected $value;

    /**
     * @param int|float $hours
     * @param int $minutes
     * @param int|float $seconds
     */
    public function __construct($hours = 0, $minutes = 0, $seconds = 0)
    {
        $this->calculateValue($hours, $minutes, $seconds);
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Returns the hour angle of the current time (hour value multiplied by 15)
     *
     * @return float
     */
    public function getHourAngle()
    {
        return $this->value * 15;
    }

    /**
     * Sets the time given as hour angle
     *
     * @param float $hourAngle
     */
    public function setHourAngle($hourAngle)
    {
        $this->value = $hourAngle / 15;
    }

    /**
     * Returns the full hours
     *
     * @return int
     */
    public function getHour()
    {
        return intval($this->value);
    }

    /**
     * Returns the full minutes
     *
     * @return int
     */
    public function getMinute()
    {
        return intval(($this->value - $this->getHour()) * 60);
    }

    /**
     * Returns the seconds
     *
     * @param bool $intval
     *
     * @return float
     */
    public function getSecond($intval = false)
    {
        $seconds = (($this->value - $this->getHour()) * 60 - $this->getMinute()) * 60;

        if ($intval) {
            return intval($seconds);
        }

        return $seconds;
    }

    /**
     * Calculate decimal hour value
     *
     * @param float|int $hours
     * @param int $minutes
     * @param float|int $seconds
     */
    protected function calculateValue($hours, $minutes, $seconds)
    {
        $this->value = $hours + $minutes / 60 + $seconds / 3600;
    }
}
