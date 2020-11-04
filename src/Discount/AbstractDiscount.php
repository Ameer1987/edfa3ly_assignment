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
     *  Gets a list of all saved discounts that apply the same discount class
     */
    abstract public function getDiscounts(): array;

    /** Sets the parameters for a discount object */
    abstract public function setParams(): void;

    /**
     *  Checks if the the discount is applicable to the list of products, if yes
     *  it returns the discount value, else it return 0
     */
    abstract public function getDiscountValue(): float;

    /**
     * Gets the discount name to be shown in the bill
     */
    abstract public function getDiscountName(): string;
}
