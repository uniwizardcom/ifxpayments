<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Test;

use Source\Model\User;
use Source\Model\Client;
use Source\Model\Bank;

class TestClientAccount
{
    private Bank\Currency $bankCurrency;
    private Client\Currency $clientCurrency;
    private User\Account $userAccount;
    private Client\Account $clientAccount;

    public function __construct()
    {
        $this->bankCurrency = new Bank\Currency('PLN', 'Polish zloty', true);
        $this->clientCurrency = new Client\Currency('PLN', 'Złote', true);

        $this->userAccount = new User\Account(
            firstName: 'Jacek',
            secondName: 'Grzegorz',
            surname: 'Kowalski'
        );

        $this->clientAccount = new Client\Account(
                firstName: 'Jacek',
                surname: 'Kowalski',
                type: Client\Types::PRIVATE,
                user: $this->userAccount,
                currency: $this->clientCurrency,
                secondName: 'Grzegorz'
            );
    }

    public function TestClientHaveSecondName(): bool
    {
        return !empty($this->clientAccount->getSecondName());
    }

    public function TestClientNotHaveSecondName(): bool
    {
        $userAccount = new Client\Account(
                firstName: 'Jacek',
                surname: 'Kowalski',
                type: Client\Types::PRIVATE,
                user: $this->userAccount,
                currency: $this->clientCurrency,
                secondName: null
            );

        return empty($userAccount->getSecondName());
    }

    public function TestClientNotGiveHisCurrencyToBank(): bool
    {
        $userAccount = new Client\Account(
                firstName: 'Jacek',
                surname: 'Kowalski',
                type: Client\Types::PRIVATE,
                user: $this->userAccount,
                currency: $this->clientCurrency,
                secondName: null
            );

        return $this->bankCurrency::class !== $userAccount->getCurrency()::class;
    }
}
