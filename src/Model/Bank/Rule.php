<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Model\Bank;

use Source\Service\Rule\RuleInterface;

class Rule implements RuleInterface
{
    public function __construct() {}

    public function check(): bool
    {
        return true;
    }

    public function getFailMessage(): string
    {
        return '';
    }
}
