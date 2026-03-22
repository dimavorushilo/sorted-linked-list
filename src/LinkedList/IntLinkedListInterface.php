<?php

declare(strict_types=1);

namespace App\LinkedList;

interface IntLinkedListInterface extends \Countable, \IteratorAggregate
{
    public function add(int $value): void;
    public function remove(int $value): bool;
    public function contains(int $value): bool;
}
