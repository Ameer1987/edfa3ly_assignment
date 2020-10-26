<?php

namespace App\Fixture;


class CurrencyFixture implements FixtureInterface
{
    public function loadData(): array
    {
        return [
            'EGP' => [
                'rate' => 15.8,
                'sign' => 'e£',
            ],
            'USD' => [
                'rate' => 1,
                'sign' => '$',
            ],
        ];
    }
}
