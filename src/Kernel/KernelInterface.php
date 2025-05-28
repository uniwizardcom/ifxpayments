<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);


namespace Source\Kernel;


interface KernelInterface
{
    public function getFilterPatern(): string;

    /**
     * @return string[]
     */
    public function getFiles(): array;

    public function getBaseDirPath(): string;

    public function run(): void;
}