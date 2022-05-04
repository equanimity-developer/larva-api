<?php

declare(strict_types=1);

namespace Tests\Feature;

trait WrongUuidListProvider
{
    public function wrongUuidListProvider(): array
    {
        return [
            [1],
            [123.12],
            ['abc'],
            ['00000000'],
        ];
    }
}