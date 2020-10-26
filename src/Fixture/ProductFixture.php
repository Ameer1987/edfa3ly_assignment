<?php

namespace App\Fixture;


class ProductFixture implements FixtureInterface
{
    public function loadData(): array
    {
        return [
            'T-shirt' => 10.99,
            'Pants' => 14.99,
            'Jacket' => 19.99,
            'Shoes' => 24.99,
        ];
    }
}
