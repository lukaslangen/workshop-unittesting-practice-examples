<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Test;

use LukasLangen\Workshop\UnitTesting\SecondExample;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class SecondExampleTest extends TestCase
{
    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function canBeInstantiated(): void
    {
        $sut = new SecondExample(
            $this->createStub(ContainerInterface::class),
            $this->createStub(LoggerInterface::class)
        );
    }
}
