<?php

namespace App\PricingStrategy\Strategy;

class MediumPricingStrategy implements PricingStrategyInterface
{
    /**
     * @param float $productPrice
     * @return float
     */
    public function getProductPrice(float $productPrice): float
    {
        return $productPrice * 0.50;
    }

    /**
     * @param float $productPrice
     * @return bool
     */
    public function shouldStrategyBeUsed(float $productPrice): bool
    {
        return $productPrice > 20 && $productPrice <= 100;
    }
}