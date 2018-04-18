<?php
declare(strict_types=1);

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

/**
 * Interface ILineItemAdapter
 * @package kdaviesnz\CPGI
 */
interface ILineItemAdapter {
	public function getName(): string;

	public function getQuantity(): float;

	public function getBasePriceMoney(): IMoneyAdapter;

	public function getTaxes(): array;

	public function getDiscounts(): array;

	public function __invoke();
}
