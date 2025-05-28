<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Model\Client;

use Source\Service\Currency as ServiceCurrency;
use Source\Service\Currency\CurrencyClientInterface;

class Currency extends ServiceCurrency\CurrencyAbstract implements CurrencyClientInterface
{
    public function __construct(
        readonly string $code,
        readonly string $name,
        private bool $isCurrent = false,
    )
    {
        parent::__construct($code, $name);
    }

    public  function setIsCurrent(bool $isCurrent):void
    {
        $this->isCurrent = $isCurrent;
    }

    public  function isCurrent(): bool
    {
        return $this->isCurrent;
    }
}
