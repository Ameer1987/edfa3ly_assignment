<?php

namespace App\Discount;

use App\Fixture\BuyNProductsGetXPercentageOnProductDiscountFixture;
use App\Fixture\ProductFixture;

class BuyNProductsGetXPercentageOnProductDiscount extends AbstractDiscount
{
    private $N;
    private $NProducts;
    private $rate;
    private $product;

    public function getDiscounts(): array
    {
        return (new BuyNProductsGetXPercentageOnProductDiscountFixture)->loadData();
    }

    public function setParams($params): void
    {
        $this->N = $params['N'];
        $this->NProducts = $params['products'];
        $this->rate = $params['rate'];
        $this->product = $params['product'];
    }

    /**
     *  checks if the the discount is applicable to a list of products, if yes
     *  it returns the discount value, else it return 0
     */
    public function getDiscountValue(): float
    {
        $productPrice = (new ProductFixture())->loadData()[$this->product];
        $NProductsCount = 0;
        $productDiscountsCount = 0;
        $productCount = array_count_values($this->products)[$this->product] ?? 0;
        foreach ($this->products as $product) {
            if ($product == $this->NProducts) {
                $NProductsCount++;
                if ($NProductsCount != 0 && $NProductsCount % $this->N == 0 && $productDiscountsCount < $productCount) {
                    $productDiscountsCount++;
                }
            }
        }

        return ($productDiscountsCount * $productPrice * $this->rate);
    }

    public function getDiscountName(): string
    {
        return ($this->rate * 100) . '% off ' . $this->product;
    }
}
