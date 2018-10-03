<?php

namespace App\PricingStrategy\Strategy;

class HighPricingStrategy implements PricingStrategyInterface
{
    /**
     * @param float $productPrice
     * @return float
     */
    public function getProductPrice(float $productPrice): float
    {
        return $productPrice * 0.10;
    }

    /**
     * @param float $productPrice
     * @return bool
     */
    public function shouldStrategyBeUsed(float $productPrice): bool
    {
        return $productPrice > 100 && $productPrice <= 500;
    }
}