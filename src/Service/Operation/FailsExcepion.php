<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Service\Operation;

use Source\Service\ArrayExceptions;
use Source\Service\Rule\RuleInterface;

class FailsExcepion extends ArrayExceptions
{
    public function addFailedRule(RuleInterface $rule): void
    {
        $this->addItem($rule->getName(), $rule);
    }

    /**
     * @return RuleInterface[]
     */
    public function getFailedRules(): array
    {
        return $this->getItems();
    }
}
