<?php

namespace App\Validator;

use App\Fixture\ProductFixture;

class ProductValidator implements ValidatorInterface
{
    private $products;
    private $availableProducts;

    public function __construct($products)
    {
        $this->products = $products;
        $this->availableProducts = (new ProductFixture())->loadData();
    }

    public function validate(): bool
    {
        foreach ($this->products as $productCode) {
            if (!in_array($productCode, array_keys($this->availableProducts))) {
                return false;
            }
        }

        return true;
    }
}
