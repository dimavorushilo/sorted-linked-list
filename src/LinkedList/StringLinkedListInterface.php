<?php

declare(strict_types=1);

namespace App\LinkedList;

interface StringLinkedListInterface extends \Countable, \IteratorAggregate
{
    public function add(string $value): void;
    public function remove(string $value): bool;
    public function contains(string $value): bool;
}
