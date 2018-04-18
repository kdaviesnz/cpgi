<?php
declare( strict_types = 1 );

// Checked for PSR2 compliance 18/4/18.

namespace kdaviesnz\CPGI;

use kdaviesnz\square\OrderRequestTax;

/**
 * Class Tax
 * @package kdaviesnz\CPGI
 */
class Tax implements ITax
{
    /**
     * @var ICPGI Payment processor
     */
    private $processor;

    /**
     * @var float Tax percent.
     */
    private $perc;

    /**
     * Tax constructor.
     *
     * @param ICPGI $processor
     * @param float $perc
     */
    public function __construct($processor, float $perc)
    {
        $this->processor = $processor;
        $this->perc     = $perc;
    }

    /**
     * The __invoke() method is called when a script tries to call an object as a function.
     * We use this to return a tax object of a particular type (eg Square) without having to
     * do something like $tax->getTax().
     * Example:
     * // Create payment gateway.
     * $commonPaymentGateway = new CPGI("square");
     * // Create tax object.
     * $tax = new Tax($commonPaymentGateway, 5.00);
     * // Automagically returns a Square tax object.
     * $squareTax = $tax();
     *
     * @return Tax|OrderRequestTax|null
     */
    public function __invoke()
    {
        $tax = null;
        switch ($this->processor->getProcessorName()) {
            case "square":
                $tax = new SquareTaxAdapter(new OrderRequestTax());
                break;
        }
        if (!is_null($tax)) {
            $tax->setPercentage($this->perc);
        }
        return $tax;
    }
}
