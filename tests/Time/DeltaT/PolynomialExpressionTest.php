<?php

declare(strict_types=1);

namespace Astrotools\Tests\Time\DeltaT;

use Astrotools\Time\DeltaT\PolynomialExpression;

class PolynomialExpressionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var PolynomialExpression
     */
    private $deltaT;

    protected function setUp(): void
    {
        $this->deltaT = new PolynomialExpression();
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab1
     */
    public function testIfCalculationWorksForYearMinus500(): void
    {
        self::assertEqualsWithDelta(17189, $this->deltaT->getDeltaT(-500), 100);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab1
     */
    public function testIfCalculationWorksForYear0(): void
    {
        self::assertEqualsWithDelta(10580, $this->deltaT->getDeltaT(0), 100);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab1
     */
    public function testIfCalculationWorksForYear1000(): void
    {
        self::assertEqualsWithDelta(1570, $this->deltaT->getDeltaT(1000), 5);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab1
     */
    public function testIfCalculationWorksForYear1900(): void
    {
        self::assertEqualsWithDelta(-3, $this->deltaT->getDeltaT(1900), 2);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab2
     */
    public function testIfCalculationWorksForYear1955(): void
    {
        self::assertEqualsWithDelta(31.1, $this->deltaT->getDeltaT(1955), 0.1);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab2
     */
    public function testIfCalculationWorksForYear1985(): void
    {
        self::assertEqualsWithDelta(54.3, $this->deltaT->getDeltaT(1985), 0.1);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab2
     */
    public function testIfCalculationWorksForYear1990(): void
    {
        self::assertEqualsWithDelta(56.9, $this->deltaT->getDeltaT(1990), 0.1);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab2
     */
    public function testIfCalculationWorksForYear2000(): void
    {
        self::assertEqualsWithDelta(63.8, $this->deltaT->getDeltaT(2000), 0.1);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab2
     */
    public function testIfCalculationWorksForYear2005(): void
    {
        self::assertEqualsWithDelta(64.7, $this->deltaT->getDeltaT(2005), 0.1);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab2
     */
    public function testIfCalculationWorksForYear2016dot125(): void
    {
        self::assertEqualsWithDelta(69.6, $this->deltaT->getDeltaT(2016.125), 0.1);
    }
}
