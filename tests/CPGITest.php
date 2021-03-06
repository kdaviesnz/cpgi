<?php

namespace kdaviesnz\CPGI;


class CPGITest extends \PHPUnit_Framework_TestCase {

	public function setUp() {

	}

	public function tearDown() {

	}

	public function testCPGI() {

		require_once("vendor/autoload.php");
		require_once("src/IPaymentGatewayAdapter.php");
		require_once("src/EscrowPaymentGatewayAdapter.php");
		require_once("src/SquarePaymentGatewayAdapter.php");
		require_once("src/StripePaymentGatewayAdapter.php");
		require_once("src/ILineItemAdapter.php");
		require_once("src/EscrowLineItemAdapter.php");
		require_once("src/SquareLineItemAdapter.php");
		require_once("src/IOrderAdapter.php");
		require_once("src/EscrowOrderAdapter.php");
		require_once("src/SquareOrderAdapter.php");
		require_once("src/IMoneyAdapter.php");
		require_once("src/SquareMoneyAdapter.php");
		require_once("src/ITaxAdapter.php");
		require_once("src/SquareTaxAdapter.php");
		require_once("src/ICPGI.php");
		require_once("src/CPGI.php");
		require_once("src/ILineItem.php");
		require_once("src/LineItem.php");
		require_once("src/ITax.php");
		require_once("src/Tax.php");
		require_once("src/IDiscount.php");
		require_once("src/Discount.php");
		require_once("src/IOrder.php");
		require_once("src/Order.php");
		require_once("vendor/kdaviesnz/square/src/IOrderRequestLineItem.php");
		require_once("vendor/kdaviesnz/square/src/OrderRequestLineItem.php");

		// Create an order (Square)
		$commonPaymentGateway = new CPGI("square", "sandbox-sq0atb-xrWTG_wv3dJqYTQaTKgovw", "", "");
		$lineItem = new LineItem($commonPaymentGateway(), "Widget", "a description", 10.50, "USD", 1, "Electronics", array(), array());
		$lineItems = array($lineItem());
		$tax = new Tax($commonPaymentGateway(), 5.00);
		$taxes = array($tax()); // 5% tax
		$discount = new Discount($commonPaymentGateway(), 5.00, 2.00, "USD");
		$discounts = array($discount());
		$order = new Order($commonPaymentGateway(), "testOrder", "USD", "buyer@example.com", "seller@example.com", "a test order", $lineItems, "", $taxes, $discounts );
		// var_dump($order());
		$squareOrder = $order();


		// https://www.escrow.com/api/docs
		// Create an order (Escrow)
		$commonPaymentGateway = new CPGI("escrow", "", "me@example.com", "escrowpassword");
		$lineItem = new LineItem($commonPaymentGateway(), "Widget", "a description", 10.50, "USD", 1, "Electronics", array(), array());
		$lineItems = array($lineItem());


		$order = new Order($commonPaymentGateway(), "testOrder", "USD", "buyer@example.com", "seller@example.com", "a test order", $lineItems, "https://api.escrow-sandbox.com/2017-09-01/transaction", array(), array() );
		//var_dump($order());
		$escrowOrder = $order();


		// https://stripe.com/docs/api/php
		// Create an order (Stripe)
		// \Stripe\Stripe::setApiKey("sk_test_BQokikJOvBiI2HlWgH4olfQ2");


	}


}
