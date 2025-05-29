<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Model\Bank;

use Source\Service\Rule\RuleInterface;

/**
 * Klasa warunku finalizowania - wykonania operacji na Value, która wcześniej została wyliczona jako symulacja
 */
class Rule implements RuleInterface
{
    private string $name;
    private ?string $message = null;
    private Account $account;
    private Value $value;

    public function __construct(
        private readonly \Closure $func
    ) {}

    public function check(): bool
    {
        return $this->func->__invoke($this, $this->account, $this->value);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }

    public function getValue(): Value
    {
        return $this->value;
    }

    public function setValue(Value $value): void
    {
        $this->value = $value;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }
}
