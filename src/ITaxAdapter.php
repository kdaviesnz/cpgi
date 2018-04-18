<?php
declare(strict_types=1);

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

/**
 * Interface ITaxAdapter
 * @package kdaviesnz\CPGI
 */
interface ITaxAdapter
{
    /**
     * Set tax percentage.
     *
     * @param float $taxPercentage
     *
     * @return mixed
     */
    public function setPercentage(float $taxPercentage);

}
