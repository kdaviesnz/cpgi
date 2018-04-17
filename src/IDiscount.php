<?php
declare(strict_types=1);

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

interface IDiscount
{
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
    public function __invoke();
}
