<?php
declare(strict_types=1);

// Checked for PSR2 compliance 18/4/18.

namespace kdaviesnz\CPGI;

/**
 * Class SquarePaymentGatewayAdapter
 * @package kdaviesnz\CPGI
 */
class SquarePaymentGatewayAdapter implements IPaymentGatewayAdapter
{
    /**
     * @var Reference to the actual Square payment gateway object.
     */
    private $squarePaymentGateway;

    /**
     * SquarePaymentGatewayAdapter constructor.
     *
     * @param $squarePaymentGateway Square payment gateway object
     */
    public function __construct($squarePaymentGateway)
    {
        $this->squarePaymentGateway = $squarePaymentGateway;
    }

    /**
     * Get the processor name.
     * @return string
     */
    public function getProcessorName(): string
    {
        return "square";
    }

    /**
     * @return mixed Get the payment gateway.
     */
    public function getPaymentGateway()
    {
        return $this->squarePaymentGateway;
    }
}
