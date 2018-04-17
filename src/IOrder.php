<?php
declare(strict_types=1);

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

/**
 * Interface IOrder
 * @package kdaviesnz\CPGI
 */
interface IOrder
{

    /**
     * The __invoke() method is called when a script tries to call an object as a function.
     *
     * Example:
     * // Create payment gateway.
     * $commonPaymentGateway = new CPGI("square", "sandbox-sq0atb-xrWTG_wv3dJqYTQaTKgovw");
     * // Create empty order object.
     * $order = new Money($commonPaymentGateway, 'test', array(), array(), array());
     * // Automagically returns a Square order object.
     * $squareOrder = $order();
     *
     * @return Order|OrderRequest|null
     */
    public function __invoke();
}
