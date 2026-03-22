<?php

declare(strict_types=1);

namespace App;

use App\Comparator\ComparatorInterface;
use Countable;
use Generator;
use IteratorAggregate;
use Traversable;

abstract class AbstractSortedLinkedList implements Countable, IteratorAggregate
{
    private ?Node $head = null;

    private int $size = 0;

    public function __construct(
        private readonly ComparatorInterface $comparator,
    ) {
    }

    protected function insertSorted(int|string $value): void
    {
        $prev = null;
        $cur = $this->head;

        while ($cur !== null && $this->compare($cur->value, $value) < 0) {
            $prev = $cur;
            $cur = $cur->next;
        }

        while ($cur !== null && $this->compare($cur->value, $value) === 0) {
            $prev = $cur;
            $cur = $cur->next;
        }

        $node = new Node($value, $cur);

        if ($prev === null) {
            $this->head = $node;
        } else {
            $prev->next = $node;
        }

        $this->size++;
    }

    protected function removeValue(int|string $value): bool
    {
        $prev = null;
        $cur = $this->head;

        while ($cur !== null) {
            $cmp = $this->compare($cur->value, $value);

            if ($cmp === 0) {
                if ($prev === null) {
                    $this->head = $cur->next;
                } else {
                    $prev->next = $cur->next;
                }

                $this->size--;
                return true;
            }

            if ($cmp > 0) {
                return false;
            }

            $prev = $cur;
            $cur = $cur->next;
        }

        return false;
    }

    protected function containsValue(int|string $value): bool
    {
        $cur = $this->head;

        while ($cur !== null) {
            $cmp = $this->compare($cur->value, $value);

            if ($cmp === 0) {
                return true;
            }

            if ($cmp > 0) {
                return false;
            }

            $cur = $cur->next;
        }

        return false;
    }

    public function count(): int
    {
        return $this->size;
    }

    public function isEmpty(): bool
    {
        return $this->size === 0;
    }

    public function clear(): void
    {
        $this->head = null;
        $this->size = 0;
    }

    public function toArray(): array
    {
        $out = [];
        $node = $this->head;
        while ($node !== null) {
            $out[] = $node->value;
            $node = $node->next;
        }

        return $out;
    }

    public function getIterator(): Traversable
    {
        return $this->iterate();
    }

    public function __clone()
    {
        $this->head = $this->cloneChain($this->head);
    }

    private function compare(int|string $a, int|string $b): int
    {
        return $this->comparator->compare($a, $b);
    }

    private function iterate(): Generator
    {
        $node = $this->head;
        while ($node !== null) {
            yield $node->value;
            $node = $node->next;
        }
    }

    private function cloneChain(?Node $node): ?Node
    {
        if ($node === null) {
            return null;
        }

        $head = new Node($node->value);
        $tail = $head;
        $node = $node->next;

        while ($node !== null) {
            $tail->next = new Node($node->value);
            $tail = $tail->next;
            $node = $node->next;
        }

        return $head;
    }
}
