<?php

namespace App\Discount;

use App\Fixture\ProductFixture;

class JacketDiscount extends AbstractDiscount
{
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
