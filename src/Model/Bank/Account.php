<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Model\Bank;

use Source\Model\Client;use Source\Service\Currency\CurrencyBankInterface;

readonly class Account
{
    private Value $balance;

    public function __construct(
        private string $number,
        private CurrencyBankInterface $currency,
        private Client\Account $client,
    ) {}

    public  function getNumber(): string
    {
        return $this->number;
    }

    public  function getBalance(): Value
    {
        return $this->balance;
    }

    public  function getCurrency(): Currency
    {
        return $this->currency;
    }

    public  function getClient(): Client\Account
    {
        return $this->client;
    }
}
