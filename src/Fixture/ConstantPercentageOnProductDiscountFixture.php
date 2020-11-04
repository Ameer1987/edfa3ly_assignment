<?php

namespace App\Fixture;


class ConstantPercentageOnProductDiscountFixture implements FixtureInterface
{
    public function loadData(): array
    {
        return [
            ['product' => 'Shoes', 'rate' => '0.1'],
        ];
    }
}
