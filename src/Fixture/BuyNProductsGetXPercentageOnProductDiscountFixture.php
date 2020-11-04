<?php

namespace App\Fixture;


class BuyNProductsGetXPercentageOnProductDiscountFixture implements FixtureInterface
{
    public function loadData(): array
    {
        return [
            ['N' => 2, 'products' => 'T-shirt', 'rate' => '0.5', 'product' => 'Jacket'],
        ];
    }
}
