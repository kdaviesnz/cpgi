<?php
declare( strict_types=1 );

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

/**
 * Interface ILineItem
 * @package kdaviesnz\CPGI
 */
interface ILineItem
{
    /**
     * The __invoke() method is called when a script tries to call an object as a function.
     * We use this to return a line item object of a particular type (eg Stripe) without having to do
     * something like $lineItem->getLineItem().
     * Example:
     * // Create payment gateway.
     * $commonPaymentGateway = new CPGI("square");
     * // Create a line item.
     * $lineItem = new LineItem($commonPaymentGateway, "Widget", 10.50, "USD", 1, "Electronics");
     * // Automagically returns a Square line item.
     * $squareLineItem = $lineItem();
     *
     * @return LineItem|OrderRequestLineItem|null
     */
    public function __invoke();
}
