<?php

namespace App\Currency;

use App\Fixture\CurrencyFixture;

class CurrencyFormatter implements CurrencyFormatterInterface
{
    /**
     * The currency to convert to
     */
    private $currency;

    /**
     * All available currencies
     */
    private $allCurrencies;

    public function __construct($currency)
    {
        $this->currency = $currency;
        $this->allCurrencies = (new CurrencyFixture)->loadData();
    }

    /**
     * Format a number
     */
    public function format($number): string
    {
        return $this->allCurrencies[$this->currency]['sign'] . round($this->convertCurrency($number), 2);
    }

    /**
     * Format array of numbers
     */
    public function formatArray($numbers): array
    {
        foreach ($numbers as &$number) {
            $number = $this->format($number);
        }

        return $numbers;
    }

    /**
     * Convert from USD to any other curreny according to the rates in the fixtures
     * Here we assume the base currency is always USD
     */
    public  function convertCurrency($number): float
    {
        $rate = $this->allCurrencies[$this->currency]['rate'];

        return ($rate * $number);
    }
}
