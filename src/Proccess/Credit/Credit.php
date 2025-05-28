<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Proccess\Credit;

use Source\Model\Bank;
use Source\Service\Operation\GeneralAbstract;

class Credit extends GeneralAbstract
{
    public function __construct(
        private Bank\Account $account,
        private Bank\Value $value
    ) {}

    public function execute(): bool
    {
        return true;
    }
}
