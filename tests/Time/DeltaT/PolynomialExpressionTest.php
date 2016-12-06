<?php
declare(strict_types = 1);

use Astrotools\Time\DeltaT\PolynomialExpression;

class PolynomialExpressionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PolynomialExpression
     */
    private $deltaT;

    public function setUp()
    {
        $this->deltaT = new PolynomialExpression();
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab1
     */
    public function testIfCalculationWorksForYearMinus500()
    {
        $this->assertEquals(17189, $this->deltaT->getDeltaT(-500), '', 100);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab1
     */
    public function testIfCalculationWorksForYear0()
    {
        $this->assertEquals(10580, $this->deltaT->getDeltaT(0), '', 100);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab1
     */
    public function testIfCalculationWorksForYear1000()
    {
        $this->assertEquals(1570, $this->deltaT->getDeltaT(1000), '', 5);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab1
     */
    public function testIfCalculationWorksForYear1900()
    {
        $this->assertEquals(-3, $this->deltaT->getDeltaT(1900), '', 2);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab2
     */
    public function testIfCalculationWorksForYear1955()
    {
        $this->assertEquals(31.1, $this->deltaT->getDeltaT(1955), '', 0.1);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab2
     */
    public function testIfCalculationWorksForYear1985()
    {
        $this->assertEquals(54.3, $this->deltaT->getDeltaT(1985), '', 0.1);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab2
     */
    public function testIfCalculationWorksForYear1990()
    {
        $this->assertEquals(56.9, $this->deltaT->getDeltaT(1990), '', 0.1);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab2
     */
    public function testIfCalculationWorksForYear2000()
    {
        $this->assertEquals(63.8, $this->deltaT->getDeltaT(2000), '', 0.1);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab2
     */
    public function testIfCalculationWorksForYear2005()
    {
        $this->assertEquals(64.7, $this->deltaT->getDeltaT(2005), '', 0.1);
    }

    /**
     * @see http://eclipse.gsfc.nasa.gov/SEcat5/deltat.html#tab2
     */
    public function testIfCalculationWorksForYear2016dot125()
    {
        $this->assertEquals(69.6, $this->deltaT->getDeltaT(2016.125), '', 0.1);
    }
}
