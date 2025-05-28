<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Model\Client;

use Source\Model\User;
use Source\Service\Currency\CurrencyClientInterface;

readonly class Account
{
    public function __construct(
        private string $firstName,
        private string $surname,
        private Types $type,
        private User\Account $user,
        private ?CurrencyClientInterface $currency = null,
        private ?string $secondName = null
    ) {}

    public  function getFirstName(): string
    {
        return $this->firstName;
    }

    public  function getSecondName(): ?string
    {
        return $this->secondName;
    }

    public  function getSurname(): string
    {
        return $this->surname;
    }

    public  function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public  function getType(): Types
    {
        return $this->type;
    }

    public  function getUser(): User\Account
    {
        return $this->user;
    }
}
