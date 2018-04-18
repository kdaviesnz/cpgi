<?php
declare(strict_types = 1);

// Checked for PSR2 compliance 18/4/18.

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
    public function __construct(String $processorName, String $accessToken, String $email, String $password)
    {
        // square, escrow, stripe
        switch (strtolower($processorName)) {
            case "square":
                $this->processor = new SquarePaymentGatewayAdapter(new Square($accessToken));
                break;
            case "escrow":
                $this->processor = new EscrowPaymentGatewayAdapter(new Escrow($password, $email));
                break;
            case "stripe":
                $this->processor = new StripePaymentGatewayAdapter(new Stripe());
                break;
        }
        $this->accessToken = $accessToken;
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
        return $this->processor;
    }
}
