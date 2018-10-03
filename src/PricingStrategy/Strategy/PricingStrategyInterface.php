<?php

namespace App\PricingStrategy\Strategy;

interface PricingStrategyInterface
{
    public function getProductPrice(float $productPrice): float;
    public function shouldStrategyBeUsed(float $productPrice): bool;
}
