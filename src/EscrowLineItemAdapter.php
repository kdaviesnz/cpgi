<?php
declare(strict_types=1);

// Checked for PSR2 compliance 18/4/18.

namespace kdaviesnz\CPGI;

/**
 * Class EscrowLineItemAdapter
 * @package kdaviesnz\CPGI
 */
class EscrowLineItemAdapter implements ILineItemAdapter
{

    /**
     * @var Reference to the actual Escrow line item object.
     */
    private $escrowLineItem;

    private $name = '';

    private $quantity = 0;

    private $discounts = array();

    /**
     * EscrowLineItemAdapter constructor.
     *
     * @param $escrowLineItem Escrow line item object
     */
    public function __construct($escrowLineItem)
    {
        $this->escrowLineItem = $escrowLineItem;
    }

    public function getName():string
    {
        return $this->escrowLineItem->getTitle();
    }

    public function getQuantity(): float
    {
        return $this->escrowLineItem->getQuantity();
    }

    public function getBasePriceMoney():IMoneyAdapter
    {
        return new EscrowMoneyAdapter();
    }

    public function getTaxes():array
    {
        return $this->escrowLineItem->getTaxes();
    }

    public function getDiscounts(): array
    {
       return $this->escrowLineItem->getDiscounts();
    }

    public function __invoke()
    {
        return $this->escrowLineItem;
    }
}
