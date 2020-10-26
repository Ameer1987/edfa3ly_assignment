<?php

namespace App\Validator;

use App\Fixture\ProductFixture;

class ProductValidator extends AbstractValidator
{
    private $products;
    private $availableProducts;

    public function __construct($products)
    {
        $this->products = $products;
        $this->availableProducts = (new ProductFixture())->loadData();
    }

    /**
     * Validate that the products are valid products
     */
    public function validate(): bool
    {
        foreach ($this->products as $productCode) {
            if (!in_array($productCode, array_keys($this->availableProducts))) {
                $this->errorMessage = $productCode . " is not an available product code";
                return false;
            }
        }

        return true;
    }
}
