<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Test;

use LukasLangen\Workshop\UnitTesting\ThirdExample;
use PHPUnit\Framework\TestCase;

final class ThirdExampleTest extends TestCase
{
    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function canBeInstantiated(): void
    {
        $sut = new ThirdExample();
    }
}
