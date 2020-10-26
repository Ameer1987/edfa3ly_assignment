<?php

namespace App\Validator;

class CartValidator extends AbstractValidator
{
    /**
     * The currency to validate
     */
    private $currency;

    /**
     * The products to validate
     */
    private $products;

    /**
     * All required children validators as array with values are the classes of the children validators and keys
     * are the names of the properties to be passes as parameters to the corresponding validators
     */
    private $validators;

    public function __construct($currency, $products)
    {
        $this->currency = $currency;
        $this->products = $products;
        $this->validators = [
            'currency' => CurrencyValidator::class,
            'products' => ProductValidator::class,
        ];
    }

    /**
     * Loop on all children validators and return false if any validator failed
     */
    public function validate(): bool
    {
        foreach ($this->validators as $propertyName => $validatorClass) {
            $validator = new $validatorClass($this->$propertyName);
            if (!$validator->validate()) {
                $this->errorMessage = $validator->getError();
                return false;
            }
        }

        return true;
    }
}
