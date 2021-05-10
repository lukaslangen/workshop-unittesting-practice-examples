<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Dependencies;

final class NullHandler implements HandlerInterface
{
    public function handle(): void
    {
        // do nothing
    }
}
