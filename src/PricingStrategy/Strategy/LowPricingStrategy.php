<?php

namespace App\PricingStrategy\Strategy;

class LowPricingStrategy implements PricingStrategyInterface
{
    /**
     * @param float $productPrice
     * @return float
     */
    public function getProductPrice(float $productPrice): float
    {
        return $productPrice * 0.90;
    }

    /**
     * @param float $productPrice
     * @return bool
     */
    public function shouldStrategyBeUsed(float $productPrice): bool
    {
        return $productPrice > 0 && $productPrice <= 20;
    }
}