<?php

namespace App\Discount;

use App\Fixture\ConstantPercentageOnProductDiscountFixture;
use App\Fixture\ProductFixture;

class ConstantPercentageOnProductDiscount extends AbstractDiscount
{
    private $product;
    private $rate;

    public function getDiscounts(): array
    {
        return (new ConstantPercentageOnProductDiscountFixture)->loadData();
    }

    public function setParams($params): void
    {
        $this->product = $params['product'];
        $this->rate = $params['rate'];
    }

    /**
     *  checks if the the discount is applicable to a list of products, if yes
     *  it returns the discount value, else it return 0
     */
    public function getDiscountValue(): float
    {
        $discount = 0;
        $productPrice = (new ProductFixture())->loadData()[$this->product];
        foreach ($this->products as $product) {
            if ($product == $this->product) {
                $discount += ($productPrice * $this->rate);
            }
        }

        return $discount;
    }

    public function getDiscountName(): string
    {
        return ($this->rate * 100) . '% off ' . $this->product;
    }
}
