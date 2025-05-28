<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);


namespace Source\Kernel;

class AllFiles extends KernelAbstract
{
    public function getFilterPatern(): string
    {
        return $this->getBaseDirPath().'/*.php';
    }

    public function run(): void
    {
        foreach ($this->getFiles() as $file)
        {
        }
    }
}