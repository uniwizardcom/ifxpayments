<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Test;

use Source\Model\Bank;
use Source\Model\Client;
use Source\Service\Currency;

class TestCurrency
{
    private Bank\Currency $bankCurrency;
    private Client\Currency $clientCurrency;

    public function __construct()
    {
        $this->bankCurrency = new Bank\Currency('PLN', 'Polish zloty', true);
        $this->clientCurrency = new Client\Currency('PLN', 'Złote', true);
    }

    public function TestBothAsEqual(): bool
    {
        return $this->bankCurrency->isEqual($this->clientCurrency);
    }

    public function TestUseForBank(): bool
    {
        return $this->bankCurrency instanceof Currency\CurrencyBankInterface;
    }

    public function TestUseForClient(): bool
    {
        return $this->clientCurrency instanceof Currency\CurrencyClientInterface;
    }

    public function TestIsNotCurrent(): bool
    {
        $clientCurrency = new Client\Currency('PLN', 'Polish zloty', false);

        return $clientCurrency->isCurrent() === false;
    }
}
