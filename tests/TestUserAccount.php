<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Test;

use Source\Model\User\Account as UserAccount;

class TestUserAccount
{
    public function TestUserHaveSecondName(): bool
    {
        $userAccount = new UserAccount(
            firstName: 'Jacek',
            secondName: 'Grzegorz',
            surname: 'Kowalski'
        );

        return !empty($userAccount->getSecondName());
    }

    public function TestUserNotHaveSecondName(): bool
    {
        $userAccount = new UserAccount(
            firstName: 'Jacek',
            secondName: null,
            surname: 'Kowalski'
        );

        return empty($userAccount->getSecondName());
    }
}
