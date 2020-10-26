<?php

namespace App\Discount;

abstract class AbstractDiscount
{
    /**
     * list of products codes to check for the discount in it
     */
    protected $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     *  checks if the the discount is applicable to a list of products, if yes
     *  it returns the discount value, else it return 0
     */
    abstract public function check(): float;
}
