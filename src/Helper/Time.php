<?php

declare(strict_types=1);

namespace Astrotools\Helper;

/**
 * Time utility class.
 *
 * @category Astrotools
 * @author   Marcus Jaschen <mjaschen@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license MIT License
 * @see     https://www.marcusjaschen.de/
 */
class Time
{
    /**
     * @var float
     */
    protected $value;

    /**
     * @param float $value
     * @return void
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @param float $hours
     * @param float $minutes
     * @param float $seconds
     * @return Time
     */
    public static function fromTime(float $hours = 0.0, float $minutes = 0.0, float $seconds = 0.0): Time
    {
        return new self(self::calculateValue($hours, $minutes, $seconds));
    }

    /**
     * @param float $hourAngle
     * @return Time
     */
    public static function fromHourAngle(float $hourAngle): Time
    {
        return new self($hourAngle / 15);
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Returns the hour angle of the current time (hour value multiplied by 15).
     *
     * @return float
     */
    public function getHourAngle(): float
    {
        return $this->value * 15;
    }

    /**
     * Returns the full hours.
     *
     * @return int
     */
    public function getHour(): int
    {
        return (int)$this->value;
    }

    /**
     * Returns the full minutes.
     *
     * @return int
     */
    public function getMinute(): int
    {
        return (int)(($this->value - $this->getHour()) * 60);
    }

    /**
     * Returns the seconds as integer.
     *
     * @return int
     */
    public function getSecond(): int
    {
        return (int)$this->getDecimalSecond();
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
     * Calculate decimal hour value.
     *
     * @param float $hours
     * @param float $minutes
     * @param float $seconds
     *
     * @return float
     */
    private static function calculateValue(float $hours, float $minutes, float $seconds): float
    {
        return $hours + $minutes / 60 + $seconds / 3600;
    }
}
