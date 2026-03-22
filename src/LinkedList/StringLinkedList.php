<?php

declare(strict_types=1);

namespace App\LinkedList;

use App\AbstractSortedLinkedList;
use App\Comparator\Factory\StringComparatorFactory;
use App\Comparator\StringComparatorInterface;

final class StringLinkedList extends AbstractSortedLinkedList implements StringLinkedListInterface
{
    public function __construct(?StringComparatorInterface $comparator = null)
    {
        parent::__construct($comparator ?? StringComparatorFactory::lexicographic());
    }

    public function add(string $value): void
    {
        $this->insertSorted($value);
    }

    public function remove(string $value): bool
    {
        return $this->removeValue($value);
    }

    public function contains(string $value): bool
    {
        return $this->containsValue($value);
    }
}
