<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Service\Operation;

use Source\Model\Bank;

interface OperationInterface
{
    public function getAccount(): Bank\Account;

    public function getValue(): Bank\Value;
}