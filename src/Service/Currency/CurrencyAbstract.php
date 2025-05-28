<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Service\Currency;

abstract class CurrencyAbstract implements CurrencyInterface
{
    public function __construct(
        private readonly string $code,
        private readonly string $name,
    )
    {}
    
    public function isEqual(CurrencyInterface $currency): bool
    {
        return $currency->getCode() === $this->getCode();
    }

    public  function getCode(): string
    {
        return $this->code;
    }

    public  function getName(): string
    {
        return $this->name;
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
