<?php

namespace App\Discount;

use App\Fixture\ProductFixture;

class ShoesDiscount extends AbstractDiscount
{
    public function check(): float
    {
        $discount = 0;
        $shoesPrice = (new ProductFixture())->loadData()['Shoes'];
        foreach ($this->products as $product) {
            if ($product == "Shoes") {
                $discount += ($shoesPrice * 0.1);
            }
        }

        return $discount;
    }
}
