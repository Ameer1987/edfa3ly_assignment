<?php

namespace App\Currency;

use App\Fixture\CurrencyFixture;

interface CurrencyFormatterInterface
{
    public function format($number): string;
    public function convertCurrency($number): float;
}
