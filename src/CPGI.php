<?php
declare( strict_types = 1 );

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

use kdaviesnz\escrow\Escrow;
use kdaviesnz\square\Square;
use Stripe\Stripe;

/**
 * Class CPGI
 *
 * @package kdaviesnz\CPGI
 */
class CPGI implements ICPGI
{

    /**
     * @var object The payment processor to use.
     */
    private $processor;

    /**
     * @var string The name of the payment processor.
     */
    private $processorName = "";

    /**
     * @var string The access token to use.
     */
    private $accessToken = "";


    /**
     * CPGI constructor.
     *
     * Initialise the payment processor.
     *
     * @param String $processor
     * @param String $accessToken
     * @param String $email
     * @param String $password
     */
    public function __construct(String $processor, String $accessToken, String $email, String $password)
    {
        // square, escrow, stripe
        switch (strtolower($processor)) {
            case "square":
                $this->processor = new Square($accessToken);
                $this->processorName = "square";
                break;
            case "escrow":
                $this->processor = new Escrow($password, $email);
                $this->processorName = "escrow";
                break;
            case "stripe":
                $this->processor = new Stripe();
                break;
        }
        $this->accessToken = $accessToken;
    }

    /**
     * Get the processor name.
     * @return string
     */
    public function getProcessorName(): string
    {
        return $this->processorName;
    }

    /**
     * The __invoke() method is called when a script tries to call an object as a function.
     * We use this to return a payment processor object without having to do something like
     * $squarePaymentGateway->getPaymentProcessor().
     * Example:
     * // Create payment gateway.
     * $commonPaymentGateway = new CPGI("square", "sandbox-sq0atb-xrWTG_wv3dJqYTQaTKgovw");
     * // Automagically returns a Square payment gateway object.
     * $squarePaymentGateway = $commonPaymentGateway();
     *
     * @return mixed
     */
    public function __invoke()
    {
        $paymentGateway = null;
        switch ($this->processorName) {
            case "square":
                $paymentGateway = new Square($this->accessToken);
                break;
            default:
                $paymentGateway = $this;
        }
        return $paymentGateway;
    }
}
