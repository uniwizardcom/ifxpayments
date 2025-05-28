<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Test;

use Source\Model\User;
use Source\Model\Client;
use Source\Model\Bank;

class TestBankAccount
{
    private Bank\Currency $bankCurrency;
    private Client\Currency $clientCurrency;
    private User\Account $userAccount;
    private Client\Account $clientAccount;
    private Bank\Account $bankAccount;

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

        $this->bankAccount = new Bank\Account(
            number: '123456789',
            currency: $this->bankCurrency,
            client: $this->clientAccount
        );
    }

    public function TestBankAccountHaveEmptyNumber(): bool
    {
        $bankAccount = new Bank\Account(
            number: '',
            currency: $this->bankCurrency,
            client: $this->clientAccount
        );

        return empty($bankAccount->getNumber());
    }

    public function TestBankAccountAcceptClientCurrency(): bool
    {
        return $this->bankAccount->getCurrency()->isEqual(
            $this->clientAccount->getCurrency()
        );
    }

    public function TestBankAccountCanNotAcceptClientCurrency(): bool
    {
        $clientCurrency = new Client\Currency('USD', 'Dolar amerykański', true);

        $clientAccount = new Client\Account(
                firstName: 'Jacek',
                surname: 'Kowalski',
                type: Client\Types::PRIVATE,
                user: $this->userAccount,
                currency: $clientCurrency,
                secondName: 'Grzegorz'
            );

        return !$this->bankAccount->getCurrency()->isEqual(
            $clientAccount->getCurrency()
        );
    }
}
