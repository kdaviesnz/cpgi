<?php
declare(strict_types=1);

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

/**
 * Class SquareLineItemAdapter
 * @package kdaviesnz\CPGI
 */
class SquareLineItemAdapter implements ILineItemAdapter
{

    /**
     * @var Reference to the actual Square line item object.
     */
    private $squareLineItem;

    /**
     * SquareLineItemAdapter constructor.
     *
     * @param $squareLineItem
     * @param float $price
     * @param string $currency
     * @param string $category
     * @param string $name
     * @param int $quantity
     */
    public function __construct(
        $squareLineItem,
        float $price,
        string $currency,
        string $category,
        string $name,
        int $quantity
    ) {
        $this->squareLineItem = $squareLineItem;
        $this->squareLineItem->setBasePriceMoney(new \kdaviesnz\square\Money($price, $currency));
        $this->squareLineItem->setCatalogObjectId($category);
        $this->squareLineItem->setName($name);
        $this->squareLineItem->setQuantity($quantity);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->squareLineItem->getName();
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->squareLineItem->getQuantity();
    }

    /**
     * @return IMoneyAdapter
     */
    public function getBasePriceMoney(): IMoneyAdapter
    {
       return new SquareMoneyAdapter($this->squareLineItem->getBasePriceMoney());
    }

    /**
     * @return array
     */
    public function getTaxes(): array
    {
        return $this->squareLineItem->getTaxes();
    }

    /**
     * @return array
     */
    public function getDiscounts(): array
    {
        return $this->squareLineItem->getDiscounts();
    }

    /**
     * @return Reference
     */
    public function __invoke()
    {
        return $this->squareLineItem;
    }
}
