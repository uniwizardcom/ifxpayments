<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Model\Bank;

use Source\Service\Currency as ServiceCurrency;
use Source\Service\Currency\CurrencyBankInterface;

class Currency extends ServiceCurrency\CurrencyAbstract implements CurrencyBankInterface
{
    public function __construct(
        readonly string $code,
        readonly string $name,
        private bool $isBase = false,
    ) {
        parent::__construct($code, $name);
    }
}
