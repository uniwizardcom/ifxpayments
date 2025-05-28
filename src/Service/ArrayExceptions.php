<?php
/**
 * Copyright ©Uniwizard All rights reserved.
 * See LICENSE_UNIWIZARD for license details.
 * @author: Uniwizard Wojciech Niewiadomski
 */
declare(strict_types=1);

namespace Source\Service;

class ArrayExceptions extends \Exception
{
    private array $items = [];

    public function addItem(string $key, mixed $item): void
    {
        $this->items[$key] = $item;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function iterate(): \Generator
    {
        foreach ($this->getItems() as $key => $item) {
            yield $key => $item->getMessage();
        };
    }
}
