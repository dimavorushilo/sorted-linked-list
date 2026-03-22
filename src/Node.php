<?php

declare(strict_types=1);

namespace App;

final class Node
{
    public function __construct(
        public readonly mixed $value,
        public ?Node $next = null,
    ) {
    }
}
