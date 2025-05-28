<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);


namespace Source\Kernel;


abstract class KernelAbstract implements KernelInterface
{
    public function __construct(
        private string $baseDirPath
    ) {}

    abstract public function getFilterPatern(): string;

    public function getFiles(): array
    {
        return array_filter(glob($this->getFilterPatern()), 'is_file');
    }

    public function getBaseDirPath(): string
    {
        return $this->baseDirPath;
    }
}
