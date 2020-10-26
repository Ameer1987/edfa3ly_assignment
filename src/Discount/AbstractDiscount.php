<?php

namespace App\Discount;

abstract class AbstractDiscount
{
    protected $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    abstract public function check(): float;
}
