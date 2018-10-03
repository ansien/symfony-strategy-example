<?php

namespace App\PricingStrategy;

use App\PricingStrategy\Strategy\PricingStrategyInterface;

class PricingStrategyContext
{
    /** @var array $strategies */
    private $strategies;

    public function __construct()
    {
        $this->strategies = [];
    }

    /**
     * @param float $productPrice
     * @return float
     */
    public function getPrice(float $productPrice): float
    {
        $strategyToUse = null;

        /** @var PricingStrategyInterface $pricingStrategy */
        foreach($this->strategies as $pricingStrategy) {
            if ($pricingStrategy->shouldStrategyBeUsed($productPrice)) {
                $strategyToUse = $pricingStrategy;
            }
        }

        if ($strategyToUse === null) {
            throw new \BadFunctionCallException('A matching pricing strategy could not found.');
        }

        return $strategyToUse->getProductPrice($productPrice);
    }

    /**
     * @param string $strategyName
     * @param PricingStrategyInterface $strategy
     */
    public function addStrategy(string $strategyName, PricingStrategyInterface $strategy): void
    {
        $this->strategies[$strategyName] = $strategy;
    }
}
