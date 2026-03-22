<?php

declare(strict_types=1);

namespace App\Comparator;

interface IntComparatorInterface extends ComparatorInterface
{
    public function compare(int $a, int $b): int;
}
