<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source;

use Source\Kernel as KernelImplementation;

readonly class Kernel
{
    public function __construct(
        private string $basePath,
    ) {}

    public function run(\Source\Spaces $space): void
    {
        ($space === Spaces::Tests)
            ? new KernelImplementation\TestFiles($this->basePath)->run()
            : new KernelImplementation\AllFiles($this->basePath)->run();
    }
}
