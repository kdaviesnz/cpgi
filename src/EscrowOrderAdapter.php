<?php
declare(strict_types=1);

// Checked for PSR2 compliance 18/4/18.

namespace kdaviesnz\CPGI;

/**
 * Class EscrowOrderAdapter
 * @package kdaviesnz\CPGI
 */
class EscrowOrderAdapter implements IOrderAdapter
{
    /**
     * @var Reference to the actual Escrow order object.
     */
    private $escrowOrder;

    /**
     * EscrowOrderAdapter constructor.
     *
     * @param $escrowProcessor
     * @param $currency
     * @param $buyerEmail
     * @param $sellerEmail
     * @param $description
     * @param $lineItems
     * @param $uri
     */
    public function __construct(
        $escrowProcessor,
        string $currency,
        string $buyerEmail,
        string $sellerEmail,
        string $description,
        array $lineItems,
        string $uri
    ) {
        $cart = new \kdaviesnz\escrow\Cart(
            $currency,
            $buyerEmail,
            $sellerEmail,
            $description
        );
        foreach ($lineItems as $lineItem) {
            $cart->addItem($lineItem());
        }
        $this->escrowOrder = $escrowProcessor->createTransaction($cart, $uri);
    }
}
