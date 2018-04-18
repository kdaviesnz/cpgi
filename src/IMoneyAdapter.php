<?php
declare(strict_types=1);

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

/**
 * Interface IMoneyAdapter
 * @package kdaviesnz\CPGI
 */
interface IMoneyAdapter {
	public function getAmount():float;
	public function getCurrency():string;
}