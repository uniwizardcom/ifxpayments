<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Model\User;

/**
 * User to nie Client.
 * Dopiery gdy User załozy konto klienckie w banku (uzyska numer) to będzie można powiązać User z Client.
 * To jest po to aby jeden User miał mozliwość założenia kilka Userów (osoba fizyczna, JDG, inne)
 */
readonly class Account
{
    public function __construct(
        private string $firstName,
        private ?string $secondName = null,
        private string $surname,
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
}
