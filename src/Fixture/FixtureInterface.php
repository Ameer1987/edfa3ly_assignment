<?php

namespace App\Fixture;


interface FixtureInterface
{
    public function loadData(): array;
}
