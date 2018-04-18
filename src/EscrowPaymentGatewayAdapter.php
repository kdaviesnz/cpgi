<?php
declare(strict_types=1);

// Checked for PSR2 compliance 18/4/18.

namespace kdaviesnz\CPGI;

/**
 * Class EscrowPaymentGatewayAdapter
 * @package kdaviesnz\CPGI
 */
class EscrowPaymentGatewayAdapter implements IPaymentGatewayAdapter
{
    /**
     * @var Reference to the actual Escrow payment gateway object.
     */
    private $escrowPaymentGateway;

    /**
     * EscrowPaymentGatewayAdapter constructor.
     *
     * @param $escrowPaymentGateway Escrow payment gateway object
     */
    public function __construct($escrowPaymentGateway)
    {
        $this->escrowPaymentGateway = $escrowPaymentGateway;
    }

    /**
     * Get the processor name.
     * @return string
     */
    public function getProcessorName(): string
    {
        return "escrow";
    }

    /**
     * @return mixed Get the payment gateway.
     */
    public function getPaymentGateway()
    {
        return $this->escrowPaymentGateway;
    }
}
