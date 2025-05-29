<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Service\Operation;

use Source\Service\Rule\RuleInterface;
use Source\Model\Bank;

abstract class GeneralAbstract implements OperationInterface
{
    /**
     * @var RuleInterface[]
     */
    private array $rules = [];

    private ?FailsExcepion $failException = null;

    public function __construct(
        private readonly Bank\Account $account,
        private readonly Bank\Value $value
    ) {
        $this->account->setOperation($this);
    }

    public function getValue(): Bank\Value
    {
        return $this->value;
    }

    public function getAccount(): Bank\Account
    {
        return $this->account;
    }

    abstract public function calculate(): void;

    /**
     * @throws FailsExcepion
     */
    public function execute(): bool
    {
        try {
            $this->operate();
            $this->checkRules();
        } catch (FailsExcepion $failsExcepion) {
            $this->getAccount()->revoke();
            throw $failsExcepion;
        }

        $this->calculate();
        $this->getAccount()->finalize();

        return true;
    }

    public function addRule(RuleInterface $rule): void
    {
        $rule->setAccount($this->account);
        $rule->setValue($this->value);

        $this->rules[] = $rule;
    }

    protected function operate(): void
    {
        foreach ($this->getAccount()->getOperators() as $operator) {
            $operator->operate();
        }
    }

    /**
     * @throws FailsExcepion
     */
    protected function checkRules(): void
    {
        $this->failException = null;
        foreach($this->rules as $rule) {
            if(!$rule->check()) {
                if(!$this->failException) {
                    $this->failException = new FailsExcepion();
                }
                $this->failException->addFailedRule($rule);
            }
        }

        if($this->failException) {
            throw $this->failException;
        }
    }

    /**
     * @return FailsExcepion|null
     */
    public function getFailException(): ?FailsExcepion
    {
        return $this->failException;
    }
}
