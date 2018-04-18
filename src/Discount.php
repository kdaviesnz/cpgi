<?php
declare(strict_types=1);

// Checked for PSR2 compliance 18/4/18.

namespace kdaviesnz\CPGI;

use kdaviesnz\square\OrderRequestDiscount;

/**
 * Class Discount
 * @package kdaviesnz\CPGI
 */
class Discount implements IDiscount
{

    /**
     * @var ICPGI The payment processor.
     */
    private $processor;

    /**
     * @var float The discount amount.
     */
    private $amount = 0.00;

    /**
     * @var string The discount currency.
     */
    private $currency = "";

    /**
     * @var float The discount percentage.
     */
    private $perc = 0.00;

    /**
     * Discount constructor.
     *
     * @param ICPGI $processor
     * @param float $amount
     * @param float $perc
     * @param String $currency
     */
    public function __construct($processor, float $amount, float $perc, String $currency)
    {
        $this->processor = $processor;
        $this->amount     = $amount;
        $this->currency = $currency;
        $this->perc = $perc;
    }

    /**
     * The __invoke() method is called when a script tries to call an object as a function.
     * We use this to return a discount object of a particular type (eg Square) without having to
     * do something like $discount->getDiscountObject().
     * Example:
     * // Create payment gateway.
     * $commonPaymentGateway = new CPGI("square");
     * // Create discount.
     * $discount = new Discount($commonPaymentGateway, 5.00, 2.00, "USD");
     * // Automagically returns a Square discount.
     * $squareDiscount = $discount();
     *
     * @return OrderRequestDiscount|null
     */
    public function __invoke()
    {
        $discount = null;
        switch ($this->processor->getProcessorName()) {
            case "square":
                $discount = new OrderRequestDiscount();
                $discount->setAmountMoney(new \kdaviesnz\square\Money($this->amount, $this->currency));
                $discount->setPercentage($this->perc);
                break;
            default:
                $discount = $this;
        }
        return $discount;
    }
}
