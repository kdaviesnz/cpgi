<?php
declare( strict_types=1 );

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

/**
 * Class Money
 * @package kdaviesnz\CPGI
 */
class Money implements IMoney
{
    /**
     * @var ICPGI Payment processor.
     */
    private $processor;

    /**
     * @var float Amount.
     */
    private $amount = 0.00;

    /**
     * @var string Currency.
     */
    private $currency = "";

    /**
     * Money constructor.
     *
     * @param ICPGI $processor
     * @param float $amount
     * @param String $currency
     */
    public function __construct(ICPGI $processor, float $amount, String $currency)
    {
        $this->processor = $processor;
        $this->amount     = $amount;
        $this->currency = $currency;
    }

    /**
     * The __invoke() method is called when a script tries to call an object as a function.
     * We use this to return a money object of a particular type (eg Square) without having to
     * do something like $money->getMoneyObject().
     * Example:
     * // Create payment gateway.
     * $commonPaymentGateway = new CPGI("square");
     *  // Create money object.
     * $money = new Money($commonPaymentGateway, 5.00, "USD");
     * // Automagically returns a Square money object.
     * $squareMoney = $money();
     *
     * @return Money|null
     */
    public function __invoke()
    {
        $money = null;
        switch ($this->processor->getProcessorName()) {
            case "square":
                $money = new \kdaviesnz\square\Money(20.00, "USD");
                break;
            default:
                $money = $this;
        }
        return $money;
    }
}
