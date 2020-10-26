<?php

namespace App\Discount;


class DiscountChecker implements DiscountCheckerInterface
{
    /**
     * list of products codes to check for applicable discounts
     */
    private $products;

    /**
     * array of all available discounts classes 
     */
    private $discounts;

    /**
     * Total discount value applied
     */
    private $totalDiscount;

    public function __construct($products)
    {
        $this->products = $products;
        $this->discounts = [
            '10% off shoes' => ShoesDiscount::class,
            '50% off jacket' => JacketDiscount::class,
        ];
    }

    /**
     * return an array with keys are the discount names and values are the discount values
     */
    public function applyDiscounts(): array
    {
        $discounts = [];
        foreach ($this->discounts as $discountName => $discountClass) {
            $discounts[$discountName] = (new $discountClass($this->products))->check();
            $this->totalDiscount += $discounts[$discountName];
        }

        return $discounts;
    }

    /**
     * Total discount value applied
     */
    public function getTotalDiscount(): float
    {
        return $this->totalDiscount;
    }
}
