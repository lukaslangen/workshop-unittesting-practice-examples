<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Test;

use Lcobucci\Clock\FrozenClock;
use LukasLangen\Workshop\UnitTesting\FirstExample;
use PHPUnit\Framework\TestCase;

final class FirstExampleTest extends TestCase
{
    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function canBeInstantiated(): void
    {
        $firstExample = new FirstExample(new FrozenClock(new \DateTimeImmutable()));
    }
}
