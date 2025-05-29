<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Proccess\Credit;

use Source\Service\Operation\GeneralAbstract;

class Credit extends GeneralAbstract
{
    public function calculate(): void
    {
        $this->getAccount()->getBalance()->addition(
            $this->getValue()
        );
    }
}
