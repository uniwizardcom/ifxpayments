<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Model\Bank;

use Source\Service\Currency\CurrencyBankInterface;

class Value
{
    private const int MULTIPLIER = 10000;

    private int $valueOriginal = 0;

    /**
     * $value reprezentuje wartość kwoty typu float z 4-ma zerami - aby zminimalizować wpływ problemu operacji zmiennoprzecinkowych
     * przykład wartość 21.33 to 213300
     * ponieważ te są obarczone możliwością nieskończonych zaokrągleń typu 21.33333333333333...
     */
    public function __construct(
        private int $value = 0
    ) {
        $this->valueOriginal = $value;
    }

    public  function getValueRaw(): int
    {
        return $this->value;
    }

    public function setValueAsFloat(float $value): void
    {
        $this->valueOriginal = $this->value = (int)($value * self::MULTIPLIER);
    }

    public function getValueAsFloat(): float
    {
        return round($this->value / self::MULTIPLIER, 2);
    }

    public function addition(Value $value): self
    {
        $this->value += $value->value;

        return $this;
    }

    public function subtraction(Value $value): self
    {
        $this->value -= $value->value;

        return $this;
    }

    public function multiplication(Value $value): self
    {
        $this->value *= $value->value;

        return $this;
    }

    public function division(Value $value): self
    {
        $this->value = (int)($this->value / $value->value);

        return $this;
    }

    public function finalize(): void
    {
        $this->valueOriginal = $this->value;
    }

    public function revoke(): void
    {
        $this->value = $this->valueOriginal;
    }
}
