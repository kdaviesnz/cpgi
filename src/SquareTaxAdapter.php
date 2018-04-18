<?php
declare(strict_types=1);

// Checked for PSR2 compliance 18/4/18.

namespace kdaviesnz\CPGI;

/**
 * Class SquareTaxAdapter
 * @package kdaviesnz\CPGI
 */
class SquareTaxAdapter implements ITaxAdapter
{

    /**
     * @var Reference to the actual Square tax object.
     */
    private $squareTax;

    /**
     * SquareTaxAdapter constructor.
     *
     * @param $squareTax Square tax object
     */
    public function __construct($squareTax)
    {
        $this->squareTax = $squareTax;
    }

    public function setPercentage( float $taxPercentage ) {
	    $this->squareTax->setPercentage($taxPercentage);
    }
}
