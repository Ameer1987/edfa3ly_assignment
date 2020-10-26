<?php

namespace App\Discount;

interface DiscountCheckerInterface
{
    public function applyDiscounts(): array;
    public function getTotalDiscount(): float;
}
