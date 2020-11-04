<?php

namespace App\Discount;


class DiscountCalculator implements DiscountCalculatorInterface
{
    /**
     * list of products codes to check for applicable discounts
     */
    private $products;

    /**
     * array of all available discounts classes 
     */
    private $discounts;

    /**
     * Total discount value applied
     */
    private $totalDiscount;

    public function __construct($products)
    {
        $this->products = $products;
        $this->discounts = [
            ConstantPercentageOnProductDiscount::class,
            BuyNProductsGetXPercentageOnProductDiscount::class,
        ];
    }

    /**
     * return an array with keys are the discount names and values are the discount values
     */
    public function applyDiscounts(): array
    {
        $discounts = [];
        foreach ($this->discounts as $discountClass) {
            $discountObject = new $discountClass($this->products);
            foreach ($discountObject->getDiscounts() as $discount) {
                $discountObject->setParams($discount);
                if ($discountValue = $discountObject->getDiscountValue()) {
                    $discounts[$discountObject->getDiscountName()] = $discountValue;
                    $this->totalDiscount += $discountValue;
                }
            }
        }

        return $discounts;
    }

    /**
     * Total discount value applied
     */
    public function getTotalDiscount(): ?float
    {
        return $this->totalDiscount;
    }
}
