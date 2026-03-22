<?php

declare(strict_types=1);

namespace App\Comparator\Factory;

use App\Comparator\IntComparatorInterface;

final class IntComparatorFactory
{
    public static function asc(): IntComparatorInterface
    {
        return new class implements IntComparatorInterface {
            public function compare(int $a, int $b): int
            {
                return $a <=> $b;
            }
        };
    }

    public static function desc(): IntComparatorInterface
    {
        return new class implements IntComparatorInterface {
            public function compare(int $a, int $b): int
            {
                return $b <=> $a;
            }
        };
    }
}
