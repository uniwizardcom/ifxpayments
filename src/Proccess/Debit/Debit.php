<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Proccess\Debit;

use Source\Service\Operation\GeneralAbstract;

class Debit extends GeneralAbstract
{
    public function calculate(): void
    {
        $this->getAccount()->getBalance()->subtraction(
            $this->getValue()
        );
    }
}
