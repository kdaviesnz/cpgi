<?php
declare( strict_types=1 );

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

use kdaviesnz\escrow\Item;
use kdaviesnz\square\OrderRequestLineItem;

/**
 * Class LineItem
 * @package kdaviesnz\CPGI
 */
class LineItem implements ILineItem
{
    /**
     * @var string The name of the item.
     */
    private $name = "";

    /**
     * @var float The price of the item.
     */
    private $price = 0.00;

    /**
     * @var string The currency the item is in.
     */
    private $currency = "";

    /**
     * @var int The number of items to be ordered.
     */
    private $quantity = 0;

    /**
     * @var string The item category.
     */
    private $category = "";

    /**
     * @var ICPGI Payment processor object.
     */
    private $processor;

    /**
     * @var string Item description.
     */
    private $description = "";

    /**
     * LineItem constructor.
     *
     * @param ICPGI $processor
     * @param string $name
     * @param string $description
     * @param float $price
     * @param string $currency
     * @param int $quantity
     * @param string $category
     */
    public function __construct(
        ICPGI $processor,
        string $name,
        string $description,
        float $price,
        string $currency,
        int $quantity,
        string $category
    ) {
        $this->processor = $processor;
        $this->name     = $name;
        $this->price    = $price;
        $this->currency = $currency;
        $this->quantity = $quantity;
        $this->category = $category;
        $this->description = $description;
    }

    /**
     * The __invoke() method is called when a script tries to call an object as a function.
     * We use this to return a line item object of a particular type (eg Stripe) without having to do
     * something like $lineItem->getLineItem().
     * Example:
     * // Create payment gateway.
     * $commonPaymentGateway = new CPGI("square");
     * // Create a line item.
     * $lineItem = new LineItem($commonPaymentGateway, "Widget", 10.50, "USD", 1, "Electronics");
     * // Automagically returns a Square line item.
     * $squareLineItem = $lineItem();
     *
     * @return LineItem|OrderRequestLineItem|null
     */
    public function __invoke()
    {
        $lineItem = null;
        switch ($this->processor->getProcessorName()) {
            case "square":
                $lineItem = new OrderRequestLineItem();
                $lineItem->setBasePriceMoney(new \kdaviesnz\square\Money($this->price, $this->currency));
                $lineItem->setCatalogObjectId($this->category);
                $lineItem->setName($this->name);
                $lineItem->setQuantity($this->quantity);
                break;
            case "escrow":
                $lineItem = new Item(
                    $this->description,
                    $this->price,
                    0,
                    $this->category,
                    $this->quantity,
                    $this->name
                );
                break;
            default:
                $lineItem = $this;
        }
        return $lineItem;
    }
}
