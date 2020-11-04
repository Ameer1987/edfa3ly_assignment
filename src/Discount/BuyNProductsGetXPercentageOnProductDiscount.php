<?php

namespace App\Discount;

use App\Fixture\ProductFixture;

class BuyNProductsGetXPercentageOnProductDiscount extends AbstractDiscount
{
    /**
     *  checks if the the discount is applicable to a list of products, if yes
     *  it returns the discount value, else it return 0
     */
    public function check(): float
    {
        $jacketPrice = (new ProductFixture())->loadData()['Jacket'];
        $tShirtsCount = 0;
        $jacketDiscountsCount = 0;
        $jacketsCount = array_count_values($this->products)['Jacket'] ?? 0;
        foreach ($this->products as $product) {
            if ($product == "T-shirt") {
                $tShirtsCount++;
                if ($tShirtsCount != 0 && $tShirtsCount % 2 == 0 && $jacketDiscountsCount < $jacketsCount) {
                    $jacketDiscountsCount++;
                }
            }
        }

        return ($jacketDiscountsCount * $jacketPrice * 0.5);
    }
}
