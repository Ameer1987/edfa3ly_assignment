<?php

namespace App\Discount;

interface DiscountCalculatorInterface
{
    public function applyDiscounts(): array;
    public function getTotalDiscount(): float;
}
