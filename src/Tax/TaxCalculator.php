<?php

namespace App\Tax;


class TaxCalculator implements TaxCalculatorInterface
{
    private $subtotal;

    public function __construct($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    /**
     * returns calculated taxes
     */
    public function calculateTaxes(): float
    {
        return $this->subtotal * 0.14;
    }
}
