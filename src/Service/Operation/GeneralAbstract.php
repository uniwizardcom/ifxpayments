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

class GeneralAbstract
{
    public function __construct(
        private readonly Bank\Account $account,
        private readonly Bank\Value $value
    ) {}

    /**
     * @throws FailsExcepion
     */
    public function execute(): bool
    {
        $this->checkRules();

        return true;
    }

    /**
     * @var RuleInterface[]
     */
    private array $rules = [];

    private ?FailsExcepion $failException = null;

    public function addRoule(RuleInterface $rule): void
    {
        $rule->setAccount($this->account);
        $rule->setValue($this->value);

        $this->rules[] = $rule;
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
