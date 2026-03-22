<?php

namespace Tests\LinkedList;

use App\Comparator\Factory\IntComparatorFactory;
use App\LinkedList\IntLinkedList;
use PHPUnit\Framework\TestCase;

class IntLinkedListTest extends TestCase
{
    public function testAddAndToArrayAscending(): void
    {
        $list = new IntLinkedList(IntComparatorFactory::asc());
        $list->add(3);
        $list->add(1);
        $list->add(2);
        $this->assertSame([1, 2, 3], $list->toArray());
    }

    public function testAddAndToArrayDescending(): void
    {
        $list = new IntLinkedList(IntComparatorFactory::desc());
        $list->add(1);
        $list->add(3);
        $list->add(2);
        $this->assertSame([3, 2, 1], $list->toArray());
    }

    public function testAddDuplicates(): void
    {
        $list = new IntLinkedList(IntComparatorFactory::asc());
        $list->add(1);
        $list->add(3);
        $list->add(3);
        $list->add(2);
        $this->assertSame([1, 2, 3, 3], $list->toArray());
    }

    public function testRemove(): void
    {
        $list = new IntLinkedList(IntComparatorFactory::asc());
        $list->add(1);
        $list->add(2);
        $list->add(3);
        $this->assertTrue($list->remove(2));
        $this->assertSame([1, 3], $list->toArray());
        $this->assertFalse($list->remove(4));
    }

    public function testContains(): void
    {
        $list = new IntLinkedList(IntComparatorFactory::asc());
        $list->add(1);
        $list->add(2);
        $this->assertTrue($list->contains(1));
        $this->assertFalse($list->contains(3));
    }

    public function testCount(): void
    {
        $list = new IntLinkedList();
        $this->assertCount(0, $list);
        $list->add(1);
        $this->assertCount(1, $list);
    }

    public function testIsEmpty(): void
    {
        $list = new IntLinkedList();
        $this->assertTrue($list->isEmpty());
        $list->add(1);
        $this->assertFalse($list->isEmpty());
    }

    public function testClear(): void
    {
        $list = new IntLinkedList();
        $list->add(1);
        $list->clear();
        $this->assertTrue($list->isEmpty());
    }

    public function testIterator(): void
    {
        $list = new IntLinkedList(IntComparatorFactory::asc());
        $list->add(2);
        $list->add(1);
        $collected = [];
        foreach ($list as $value) {
            $collected[] = $value;
        }
        $this->assertSame([1, 2], $collected);
    }

    public function testClone(): void
    {
        $list = new IntLinkedList(IntComparatorFactory::asc());
        $list->add(1);
        $list->add(2);
        $copy = clone $list;
        $copy->add(3);
        $this->assertSame([1, 2], $list->toArray());
        $this->assertSame([1, 2, 3], $copy->toArray());
    }
}
