<?php

namespace App\Domain;

class CurrencyDomain
{
    public function checkCurrency($currency)
    {
        return !empty($currency) ? strtoupper($currency) : 'USD';
    }
}
