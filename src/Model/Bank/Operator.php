<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Model\Bank;

/**
 * Klasa operatora Value wprowada modyfikacje obliczania vartości
 */
class Operator
{
    private $name;
    private Account $account;
    private Value $value;

    public function __construct(
        private readonly Closure $func
    ) {}
}
