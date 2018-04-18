<?php
declare( strict_types=1 );

// Checked for PSR2 compliance 18/4/18.

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
     * @var  Payment processor object.
     */
    private $processor;

	/**
	 * @var array taxes
	 */
	private $taxes = array();

	/**
	 * @var array discounts
	 */
	private $discounts = array();

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
        $processor,
        string $name,
        string $description,
        float $price,
        string $currency,
        int $quantity,
        string $category,
        array $taxes,
        array $discounts
    ) {
        $this->processor = $processor;
        $this->name     = $name;
        $this->price    = $price;
        $this->currency = $currency;
        $this->quantity = $quantity;
        $this->category = $category;
        $this->description = $description;
        $this->taxes = $taxes;
        $this->discounts = $discounts;
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
                $lineItem = new SquareLineItemAdapter(
                    new OrderRequestLineItem(),
                    $this->price,
                    $this->currency,
                    $this->category,
                    $this->name,
                    $this->quantity,
                    $this->taxes
                );
                break;
            case "escrow":
                // @todo we should be able to get name, quantity etc from the Item object.
                $item = new Item(
                    $this->description,
                    $this->price,
                    0,
                    $this->category,
                    $this->quantity,
                    $this->name,
                    $this->taxes,
                    $this->discounts
                );
                $lineItem = new EscrowLineItemAdapter(
                    $item
                );
                break;
        }
        return $lineItem;
    }
}
