<?php

namespace App\Validator;

use App\Fixture\CurrencyFixture;

class CurrencyValidator implements ValidatorInterface
{
    private $currency;
    private $availableCurrencies;

    public function __construct($currency)
    {
        $this->currency = $currency;
        $this->availableCurrencies = (new CurrencyFixture())->loadData();
    }

    public function validate(): bool
    {
        if (!in_array($this->currency, array_keys($this->availableCurrencies))) {
            return false;
        }

        return true;
    }
}
