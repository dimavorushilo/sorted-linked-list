<?php

namespace Tests\LinkedList;

use App\Comparator\Factory\StringComparatorFactory;
use App\LinkedList\StringLinkedList;
use PHPUnit\Framework\TestCase;

class StringLinkedListTest extends TestCase
{
    public function testAddAndToArrayLexicographic(): void
    {
        $list = new StringLinkedList(StringComparatorFactory::lexicographic());
        $list->add('b');
        $list->add('a');
        $list->add('c');
        $this->assertSame(['a', 'b', 'c'], $list->toArray());
    }

    public function testAddAndToArrayDescending(): void
    {
        $list = new StringLinkedList(StringComparatorFactory::desc());
        $list->add('a');
        $list->add('c');
        $list->add('b');
        $this->assertSame(['c', 'b', 'a'], $list->toArray());
    }

    public function testAddAndToArrayCaseInsensitive(): void
    {
        $list = new StringLinkedList(StringComparatorFactory::caseInsensitive());
        $list->add('B');
        $list->add('a');
        $list->add('c');
        $this->assertSame(['a', 'B', 'c'], $list->toArray());
    }

    public function testAddDuplicates(): void
    {
        $list = new StringLinkedList(StringComparatorFactory::lexicographic());
        $list->add('a');
        $list->add('c');
        $list->add('c');
        $list->add('b');
        $this->assertSame(['a', 'b', 'c', 'c'], $list->toArray());
    }

    public function testRemove(): void
    {
        $list = new StringLinkedList(StringComparatorFactory::lexicographic());
        $list->add('a');
        $list->add('b');
        $list->add('c');
        $this->assertTrue($list->remove('b'));
        $this->assertSame(['a', 'c'], $list->toArray());
        $this->assertFalse($list->remove('d'));
    }

    public function testContains(): void
    {
        $list = new StringLinkedList(StringComparatorFactory::lexicographic());
        $list->add('a');
        $list->add('b');
        $this->assertTrue($list->contains('a'));
        $this->assertFalse($list->contains('c'));
    }

    public function testCount(): void
    {
        $list = new StringLinkedList();
        $this->assertCount(0, $list);
        $list->add('a');
        $this->assertCount(1, $list);
    }

    public function testIsEmpty(): void
    {
        $list = new StringLinkedList();
        $this->assertTrue($list->isEmpty());
        $list->add('a');
        $this->assertFalse($list->isEmpty());
    }

    public function testClear(): void
    {
        $list = new StringLinkedList();
        $list->add('a');
        $list->clear();
        $this->assertTrue($list->isEmpty());
    }

    public function testIterator(): void
    {
        $list = new StringLinkedList(StringComparatorFactory::lexicographic());
        $list->add('b');
        $list->add('a');
        $collected = [];
        foreach ($list as $value) {
            $collected[] = $value;
        }
        $this->assertSame(['a', 'b'], $collected);
    }

    public function testClone(): void
    {
        $list = new StringLinkedList(StringComparatorFactory::lexicographic());
        $list->add('a');
        $list->add('b');
        $copy = clone $list;
        $copy->add('c');
        $this->assertSame(['a', 'b'], $list->toArray());
        $this->assertSame(['a', 'b', 'c'], $copy->toArray());
    }
}
