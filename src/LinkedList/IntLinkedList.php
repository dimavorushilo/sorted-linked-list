<?php

declare(strict_types=1);

namespace App\LinkedList;

use App\AbstractSortedLinkedList;
use App\Comparator\Factory\IntComparatorFactory;
use App\Comparator\IntComparatorInterface;

final class IntLinkedList extends AbstractSortedLinkedList implements IntLinkedListInterface
{
    public function __construct(?IntComparatorInterface $comparator = null)
    {
        parent::__construct($comparator ?? IntComparatorFactory::asc());
    }

    public function add(int $value): void
    {
        $this->insertSorted($value);
    }

    public function remove(int $value): bool
    {
        return $this->removeValue($value);
    }

    public function contains(int $value): bool
    {
        return $this->containsValue($value);
    }
}
