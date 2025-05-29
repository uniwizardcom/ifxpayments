<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Model\Bank;

use AllowDynamicProperties;
use Source\Model\Client;
use Source\Service\Currency\CurrencyBankInterface;
use Source\Service\Operation\OperationInterface;
use Source\Service\Operator\OperatorInterface;

class Account
{
    private Value $balance;

    /**
     * @var OperatorInterface[]
     */
    private array $operators;
    
    private ?OperationInterface $operation = null;

    public function __construct(
        readonly private string $number,
        readonly private CurrencyBankInterface $currency,
        readonly private Client\Account $client,
    ) {
        $this->balance = new Value();
        $this->operators = [];
    }

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

    public function addOperator(OperatorInterface $operator): void
    {
        $this->operators[] = $operator;
    }

    /**
     * @return OperatorInterface[]
     */
    public function getOperators(): array
    {
        foreach ($this->operators as $key => $operator) {
            $this->operators[$key]->setAccount($this);
            $this->operators[$key]->setValue($this->getOperation()->getValue());
        }

        return $this->operators;
    }
    
    public function setOperation(?OperationInterface $operation): void
    {
        $this->operation = $operation;
    }

    public function getOperation(): ?OperationInterface
    {
        return $this->operation;
    }

    public function finalize(): void
    {
        $this->getBalance()->finalize();
    }

    public function revoke(): void
    {
        $this->getBalance()->revoke();
    }
}
