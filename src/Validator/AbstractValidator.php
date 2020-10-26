<?php

namespace App\Validator;

abstract class AbstractValidator
{
    protected $errorMessage;

    abstract public function validate(): bool;

    public function getError(): string
    {
        return $this->errorMessage;
    }
}
