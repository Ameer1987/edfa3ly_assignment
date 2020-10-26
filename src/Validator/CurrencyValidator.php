<?php

namespace App\Validator;

use App\Fixture\CurrencyFixture;

class CurrencyValidator extends AbstractValidator
{
    private $currency;
    private $availableCurrencies;

    public function __construct($currency)
    {
        $this->currency = $currency;
        $this->availableCurrencies = (new CurrencyFixture())->loadData();
    }

    /**
     * Validate that the currency is a valid currency
     */
    public function validate(): bool
    {
        if (!in_array($this->currency, array_keys($this->availableCurrencies))) {
            $this->errorMessage = $this->currency . " is not an available currency";
            return false;
        }

        return true;
    }
}
