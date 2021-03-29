<?php

declare(strict_types=1);

namespace Astrotools\Helper;

class Angle
{
    public static function normalizeDegrees(float $degrees): float
    {
        while ($degrees < 0) {
            $degrees += 360;
        }

        while ($degrees >= 360) {
            $degrees -= 360;
        }

        return $degrees;
    }
}
