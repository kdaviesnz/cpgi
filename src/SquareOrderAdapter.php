<?php
declare(strict_types=1);

// Checked for PSR2 compliance 18/4/18.

namespace kdaviesnz\CPGI;

/**
 * Class SquareOrderAdapter
 * @package kdaviesnz\CPGI
 */
class SquareOrderAdapter implements IOrderAdapter
{
    /**
     * @var Reference to the actual Square order object.
     */
    private $squareOrder;

    /**
     * SquareOrderAdapter constructor.
     *
     * @param $squareOrder Square processor object
     */
    public function __construct(
        $squareProcessor,
        $locationId,
        $idempotencyKey,
        $reference,
        $lineItems,
        $taxes,
        $discounts
    )
    {
        $this->squareOrder = $squareProcessor->createOrder(
            $locationId,
            $idempotencyKey,
            $reference,
            $lineItems,
            $taxes,
            $discounts
        );
    }
}

