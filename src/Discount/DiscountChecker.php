<?php

namespace App\Discount;


class DiscountChecker implements DiscountCheckerInterface
{
    private $products;
    private $discounts;
    private $totalDiscount;

    public function __construct($products)
    {
        $this->products = $products;
        $this->discounts = [
            '10% off shoes' => ShoesDiscount::class,
            '50% off jacket' => JacketDiscount::class,
        ];
    }

    public function applyDiscounts(): array
    {
        $discounts = [];
        foreach ($this->discounts as $discountName => $discountClass) {
            $discounts[$discountName] = (new $discountClass($this->products))->check();
            $this->totalDiscount += $discounts[$discountName];
        }

        return $discounts;
    }

    public function getTotalDiscount(): float
    {
        return $this->totalDiscount;
    }
}
