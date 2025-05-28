<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Service\Rule;

use Source\Model\Bank;

interface RuleInterface
{
    public function setName($name): void;

    public function getName(): string;

    public function setAccount(Bank\Account $account): void;

    public function setValue(Bank\Value $value): void;

    public function setMessage(?string $message): void;

    public function getMessage(): ?string;
}
