<?php

declare(strict_types=1);

namespace App\Comparator;

interface StringComparatorInterface extends ComparatorInterface
{
    public function compare(string $a, string $b): int;
}
