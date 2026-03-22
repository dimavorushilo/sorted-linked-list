<?php

declare(strict_types=1);

namespace App\Comparator\Factory;

use App\Comparator\StringComparatorInterface;

final class StringComparatorFactory
{
    public static function lexicographic(): StringComparatorInterface
    {
        return new class implements StringComparatorInterface {
            public function compare(string $a, string $b): int
            {
                return $a <=> $b;
            }
        };
    }

    public static function desc(): StringComparatorInterface
    {
        return new class implements StringComparatorInterface {
            public function compare(string $a, string $b): int
            {
                return $b <=> $a;
            }
        };
    }

    public static function caseInsensitive(): StringComparatorInterface
    {
        return new class implements StringComparatorInterface {
            public function compare(string $a, string $b): int
            {
                return strcasecmp($a, $b);
            }
        };
    }
}
