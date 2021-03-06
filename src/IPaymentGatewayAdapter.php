<?php
declare(strict_types=1);

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

/**
 * Interface IMoneyAdapter
 * @package kdaviesnz\CPGI
 */
interface IPaymentGatewayAdapter {

    /**
     * Get the processor name.
     * @return string
     */
    public function getProcessorName(): string;


    /**
     * @return mixed Get the payment gateway eg Stripe.
     */
    public function getPaymentGateway();

}