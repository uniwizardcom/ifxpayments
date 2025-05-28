<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Service\Operation;

use Source\Service\Rule\RuleInterface;

class GeneralAbstract
{
    /**
     * @var RuleInterface[]
     */
    private array $rules = [];

    /**
     * @var string[]
     */
    private array $ruleFails = [];

    public function addRoule(RuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }

    private function canAfterCheckRules(): bool
    {
        foreach($this->rules as $rule) {
            if(!$rule->check()) {
                $this->ruleFails[] = $rule->getFailMessage();
            }
        }

        return empty($this->ruleFails);
    }
}
