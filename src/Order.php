<?php
declare(strict_types=1);

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

use kdaviesnz\escrow\Cart;

/**
 * Class Order
 * @package kdaviesnz\CPGI
 */
class Order implements IOrder
{

    /**
     * @var ICPGI Payment processor
     */
    private $processor;

    /**
     * @var Location id.
     */
    private $locationId;

    /**
     * @var string Idempotency key.
     */
    private $idempotencyKey;

    /**
     * @var string Reference.
     */
    private $reference = "";

    /**
     * @var array Array of line items.
     */
    private $lineItems = array();

    /**
     * @var array Array of tax objects.
     */
    private $taxes = array();

    /**
     * @var array Array of discount objects.
     */
    private $discounts = array();

    /**
     * @var string The currency the order is in.
     */
    private $currency = "";

    /**
     * @var string The buyer's email.
     */
    private $buyerEmail = "";

    /**
     * @var string The seller's email.
     */
    private $sellerEmail = "";

    /**
     * @var string Description for the order.
     */
    private $description = "";

    /**
     * @var string uri to be used for transactions.
     */
    private $uri = "";

    /**
     * Order constructor.
     *
     * @param ICPGI $processor
     * @param String $reference
     * @param String $currency
     * @param String $buyerEmail
     * @param String $sellerEmail
     * @param String $description
     * @param array $lineItems
     * @param String $uri
     * @param array $taxes
     * @param array $discounts
     */
    public function __construct(
    	ICPGI $processor,
	    String $reference,
	    String $currency,
	    String $buyerEmail,
	    String $sellerEmail,
	    String $description,
	    array $lineItems,
	    String $uri,
	    array $taxes,
	    array $discounts
    ) {
        $this->processor = $processor;
        $this->reference = $reference;
        $this->idempotencyKey = uniqid();

        $this->lineItems = $lineItems;
        $this->taxes = $taxes;

        $this->currency = $currency;
        $this->buyerEmail = $buyerEmail;
        $this->sellerEmail = $sellerEmail;
        $this->description =$description;

        switch ($this->processor->getProcessorName()) {
            case "square":
                $result = $processor()->getLocations();
                $this->locationId = $result->locations[0]->id;
                break;
            default:
        }
    }

    /**
     * The __invoke() method is called when a script tries to call an object as a function.
     *
     * Example:
     * // Create payment gateway.
     * $commonPaymentGateway = new CPGI("square", "sandbox-sq0atb-xrWTG_wv3dJqYTQaTKgovw");
     * // Create empty order object.
     * $order = new Money($commonPaymentGateway, 'test', array(), array(), array());
     * // Automagically returns a Square order object.
     * $squareOrder = $order();
     *
     * @return Order|\kdaviesnz\square\OrderRequest|null
     */
    public function __invoke()
    {
        $order = null;
        switch ($this->processor->getProcessorName()) {
            case "square":
                $p = $this->processor;
                $square = $p();
                $order = $square->createOrder(
                    $this->locationId,
                    $this->idempotencyKey,
                    $this->reference,
                    $this->lineItems,
                    $this->taxes,
                    $this->discounts
                );
                break;
            case "escrow":
                $order = new Cart($this->currency, $this->buyerEmail, $this->sellerEmail, $this->description);
                //  Escrow.Cart::public function addItem(IItem $item)
                foreach ($this->lineItems as $lineItem) {
                    $order->addItem($lineItem);
                }
                $p = $this->processor;
                $escrow = $p();
                $escrow->createTransaction($order, $this->uri);
                break;
            default:
                $order = $this;
        }
        return $order;
    }
}
