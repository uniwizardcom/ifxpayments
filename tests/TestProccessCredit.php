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
use Source\Proccess\Credit\Credit as ProccessCredit;
use Source\Service\Operation\FailsExcepion;

class TestProccessCredit
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

    /**
     * @throws FailsExcepion
     */
    public function TestBankAccountCreditCurrency(): bool
    {
        $value = new Bank\Value();
        $value->setValueAsFloat(2150.35);

        $proccessCredit = new ProccessCredit(
            account: $this->bankAccount,
            value: $value
        );
        $proccessCredit->addRule(new Bank\Rule(function(Bank\Rule $rule, Bank\Account $bankAccount, Bank\Value $value) {
            $rule->setName('Waluty');
            $rule->setMessage('Waluty się nie zgadzają');
            return $bankAccount->getCurrency()->isEqual(
                $bankAccount->getClient()->getCurrency()
            );
        }));

        return $proccessCredit->execute();
    }

    /**
     * @throws FailsExcepion
     */
    public function TestBankAccountCreditValue(): bool
    {
        $value = new Bank\Value();
        $value->setValueAsFloat(2150.35);

        $proccessCredit = new ProccessCredit(
            account: $this->bankAccount,
            value: $value
        );
        $proccessCredit->addRule(new Bank\Rule(function(Bank\Rule $rule, Bank\Account $bankAccount, Bank\Value $value) {
            $rule->setName('Kwota');
            $rule->setMessage('Kwota musi być większa od zera');
            return $value->getValueRaw() > 0;
        }));

        return $proccessCredit->execute();
    }

    /**
     * @throws FailsExcepion
     */
    public function TestBankAccountDebitValue(): bool
    {
        $value = new Bank\Value();
        $value->setValueAsFloat(2150.35);

        $proccessCredit = new ProccessCredit(
            account: $this->bankAccount,
            value: $value
        );
        $proccessCredit->addRule(new Bank\Rule(function(Bank\Rule $rule, Bank\Account $bankAccount, Bank\Value $value) {
            $rule->setName('Kwota');
            $rule->setMessage('Kwota musi być większa od zera');
            return $value->getValueRaw() > 0;
        }));

        return $proccessCredit->execute();
    }
}
