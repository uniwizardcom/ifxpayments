<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 *
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);


namespace Source\Kernel;

class TestFiles extends KernelAbstract
{
    public function getFilterPatern(): string
    {
        return $this->getBaseDirPath().'/Test*.php';
    }
    
    public function run(): void
    {
        foreach ($this->getFiles() as $filePath)
        {
            require_once $filePath;
            $className = basename($filePath, '.php');
            $classNamespaced = 'Test\\'.$className;

            $testObject = new $classNamespaced();
            foreach ($this->getTests($testObject) as $testMethods) {
                echo sprintf('Running: %s->%s()', $className, $testMethods);

                $res = false;
                $failMessage = null;
                try {
                    $res = $testObject->{$testMethods}();
                } catch (\Throwable $e) {
                    $failMessage = $e->getMessage();
                }

                if($res === true) {
                    echo ' OK';
                } else {
                    echo ' Failed';
                    if($failMessage !== null) {
                        echo ' with message: '.PHP_EOL.'      '.$failMessage;
                    }

                }

                echo PHP_EOL;
            }
        }
    }

    /**
     * @return string[]
     */
    private function getTests(object $object): array
    {
        return array_filter(
            get_class_methods($object),
            function ($method) {
                return !strncmp($method, 'Test', 4);
            }
        );
    }
}
