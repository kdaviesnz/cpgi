<?php
declare( strict_types = 1 );

// Checked for PSR2 compliance 17/4/18.
namespace kdaviesnz\CPGI;

/**
 * Interface ITax
 * @package kdaviesnz\CPGI
 */
interface ITax
{
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
    public function __invoke();
}
