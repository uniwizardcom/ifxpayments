<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Model\Bank;

use Source\Service\Operator\OperatorInterface;

/**
 * Klasa operatora Value wprowada modyfikacje obliczania vartości
 */
class Operator implements OperatorInterface
{
    private string $name;
    private Account $account;
    private Value $value;

    public function __construct(
        private readonly \Closure $func
    ) {}

    public function operate(): void
    {
        $this->func->__invoke($this, $this->account, $this->value);
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
}
