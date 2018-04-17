# cpgi

## Install

Via Composer

``` bash
$ composer require kdaviesnz/cpgi
```

## Usage

NOTE:  This is code is currently in ALPHA and is not guaranteed to work. DO NOT USE IN PRODUCTION. It has not been tested with actual payments etc. If anything, think of it as a starting point.

``` php

		// Create an order (Square)
		$commonPaymentGateway = new CPGI("square", "sandbox-sq0atb-xrWTG_wv3dJqYTQaTKgovw", "", "");
		$lineItem = new LineItem($commonPaymentGateway, "Widget", "a description", 10.50, "USD", 1, "Electronics");
		$lineItems = array($lineItem());
		$tax = new Tax($commonPaymentGateway, 5.00);
		$taxes = array($tax()); // 5% tax
		$discount = new Discount($commonPaymentGateway, 5.00, 2.00, "USD");
		$discounts = array($discount());
		$order = new Order($commonPaymentGateway, "testOrder", "USD", "buyer@example.com", "seller@example.com", "a test order", $lineItems, "", $taxes, $discounts );

```

## Change log

Please see CHANGELOG.md for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see CONTRIBUTING.md and CODE_OF_CONDUCT.md for details.

## Security

If you discover any security related issues, please email kdaviesnz@gmail.com instead of using the issue tracker.

## Credits

- kdaviesnz@gmail.com

## License

The MIT License (MIT). Please see LICENSE.md for more information.

cpgi
