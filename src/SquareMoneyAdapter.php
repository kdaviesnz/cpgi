<?php
declare(strict_types=1);

// Checked for PSR2 compliance 18/4/18.

namespace kdaviesnz\CPGI;

/**
 * Class SquareMoneyAdapter
 * @package kdaviesnz\CPGI
 */
class SquareMoneyAdapter implements IMoneyAdapter
{

    /**
     * @var Reference to the actual Square money object.
     */
    private $squareMoney;

    /**
     * SquareMoneyAdapter constructor.
     *
     * @param $squareMoney Square money object
     */
    public function __construct($squareMoney)
    {
        $this->squareMoney = $squareMoney;
    }

    /**
     * @return float
     */
    public function getAmount():float
    {
        return $this->squareMoney->getAmount();
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->squareMoney->getCurrency();
    }
}
