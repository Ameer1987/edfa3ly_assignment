<?php

namespace App\Tax;


interface TaxCalculatorInterface
{
    public function calculateTaxes(): float;
}
