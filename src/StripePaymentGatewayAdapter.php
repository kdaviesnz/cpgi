<?php
declare(strict_types=1);

// Checked for PSR2 compliance 18/4/18.

namespace kdaviesnz\CPGI;

/**
 * Class StripePaymentGatewayAdapter
 * @package kdaviesnz\CPGI
 */
class StripePaymentGatewayAdapter implements IPaymentGatewayAdapter
{
    /**
     * @var Reference to the actual Stripe payment gateway object.
     */
    private $stripePaymentGateway;

    /**
     * StripePaymentGatewayAdapter constructor.
     *
     * @param $stripePaymentGateway Stripe payment gateway object
     */
    public function __construct($stripePaymentGateway)
    {
        $this->stripePaymentGateway = $stripePaymentGateway;
    }

    /**
     * Get the processor name.
     * @return string
     */
    public function getProcessorName(): string
    {
        return "stripe";
    }

	/**
	 * @return mixed Get the payment gateway.
	 */
	public function getPaymentGateway()
	{
		return $this->stripePaymentGateway;
	}
}
