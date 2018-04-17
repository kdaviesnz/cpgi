<?php
declare(strict_types=1);

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

/**
 * Interface IMoney
 * @package kdaviesnz\CPGI
 */
interface IMoney
{
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
    public function __invoke();
}
