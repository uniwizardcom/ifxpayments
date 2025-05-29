<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Test;

use Source\Model\Bank\Value;
use Source\Model\User;
use Source\Model\Client;
use Source\Model\Bank;
use Source\Proccess\Debit\Debit as ProccessDebit;
use Source\Service\Operation\FailsExcepion;

class TestProccessDebit
{
    private const float RESULT_1 = 4959.80;
    private const float RESULT_2 = 4155.80;

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
        $this->bankAccount->getBalance()->addition(new Value(50000000));
        $this->bankAccount->addOperator(new Bank\Operator(function(Bank\Operator $operator, Bank\Account $bankAccount, Bank\Value $value) {
            $transCostPercent = 0.5;
            $transCost = new Value();
            $transCost->setValueAsFloat(($transCostPercent/100) * $value->getValueAsFloat());
            $bankAccount->getBalance()->subtraction($transCost);
        }));

        echo sprintf('Balance 0: %.2f', $this->bankAccount->getBalance()->getValueAsFloat()).PHP_EOL;
    }

    /**
     * @throws FailsExcepion
     */
    public function TestBankAccountDebitCurrency(): bool
    {
        $value = new Bank\Value();
        $value->setValueAsFloat(40);

        $proccessDebit = new ProccessDebit(
            account: $this->bankAccount,
            value: $value
        );
        $proccessDebit->addRule(new Bank\Rule(function(Bank\Rule $rule, Bank\Account $bankAccount, Bank\Value $value) {
            $rule->setName('Waluty');
            $rule->setMessage('Waluty się nie zgadzają');
            return $bankAccount->getCurrency()->isEqual(
                $bankAccount->getClient()->getCurrency()
            );
        }));
        $status = $proccessDebit->execute();

        echo PHP_EOL.sprintf('Balance 1 (5000.00 - (40.00 * 1.005(0.5%%)) = %.2f): %.2f',
                self::RESULT_1,
                $this->bankAccount->getBalance()->getValueAsFloat()
            );

        return $status && (self::RESULT_1 === $this->bankAccount->getBalance()->getValueAsFloat());
    }

    /**
     * @throws FailsExcepion
     */
    public function TestBankAccountDebitValue(): bool
    {
        $value = new Bank\Value();
        $value->setValueAsFloat(800);

        $proccessDebit = new ProccessDebit(
            account: $this->bankAccount,
            value: $value
        );

        $proccessDebit->addRule(new Bank\Rule(function(Bank\Rule $rule, Bank\Account $bankAccount, Bank\Value $value) {
            $rule->setName('Kwota');
            $rule->setMessage('Kwota musi być większa od zera');
            return $value->getValueRaw() > 0;
        }));
        $proccessDebit->addRule(new Bank\Rule(function(Bank\Rule $rule, Bank\Account $bankAccount, Bank\Value $value) {
            $rule->setName('Prowizja 0.5%');
            $rule->setMessage('Kwota + Prowizja 5% musi być większa od balansu na koncie po operacji');
            return $value->getValueRaw() > 0;
        }));
        $status = $proccessDebit->execute();

        echo PHP_EOL.sprintf('Balance 2 (4959.80 - (800.00 * 1.005(0.5%%)) = %.2f): %.2f',
                self::RESULT_2,
                $this->bankAccount->getBalance()->getValueAsFloat()
            );

        return $status && (self::RESULT_2 === $this->bankAccount->getBalance()->getValueAsFloat());
    }
}
