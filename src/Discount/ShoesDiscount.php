<?php

namespace App\Discount;

use App\Fixture\ProductFixture;

class ShoesDiscount extends AbstractDiscount
{
    /**
     *  checks if the the discount is applicable to a list of products, if yes
     *  it returns the discount value, else it return 0
     */
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
