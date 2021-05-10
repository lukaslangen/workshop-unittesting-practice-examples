<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Test;

use LukasLangen\Workshop\UnitTesting\Dependencies\NullHandler;
use LukasLangen\Workshop\UnitTesting\Dependencies\RequestHandler;
use LukasLangen\Workshop\UnitTesting\Dependencies\ResponseHandler;
use LukasLangen\Workshop\UnitTesting\SecondExample;
use LukasLangen\Workshop\UnitTesting\Test\Shared\ContainerDoubleFactory;
use LukasLangen\Workshop\UnitTesting\Test\Shared\LoggerDoubleFactory;
use PHPUnit\Framework\TestCase;

final class SecondExampleTest extends TestCase
{
    /**
     * @test
     * @dataProvider knownTypesToClassMappingProvider
     * @dataProvider mappingsForNullHandlerProvider
     */
    public function createsCorrectHandler(string $type, string $expectedType): void
    {
        $container = ContainerDoubleFactory::createFake($this->getContainerMapping());
        $logger = LoggerDoubleFactory::createDummy();

        $sut = new SecondExample($container, $logger);

        $this->assertInstanceOf($expectedType, $sut->create($type));
    }

    /**
     * @test
     * @dataProvider mappingsForNullHandlerProvider
     */
    public function logsInfoMessageOnUnknownType(string $type): void
    {
        $container = ContainerDoubleFactory::createFake($this->getContainerMapping());

        $logger = LoggerDoubleFactory::createMock($this);
        $logger->expects($this->once())
            ->method('info')
            ->with($this->equalTo("Mapping for type '$type' doesn't exist"));

        $sut = new SecondExample($container, $logger);
        $sut->create($type);
    }

    public function knownTypesToClassMappingProvider(): iterable
    {
        yield 'request' => ['type' => 'request', 'expectedType' => RequestHandler::class];
        yield 'response' => ['type' => 'response', 'expectedType' => ResponseHandler::class];
    }

    public function mappingsForNullHandlerProvider(): iterable
    {
        yield 'gibberish' => ['type' => 'gibberish', 'expectedType' => NullHandler::class];
        yield 'more-gibberish' => ['type' => 'more-gibberish', 'expectedType' => NullHandler::class];
    }

    private function getContainerMapping(): array
    {
        return [
            NullHandler::class => function () { return new NullHandler(); },
            RequestHandler::class => function () { return new RequestHandler(); },
            ResponseHandler::class => function () { return new ResponseHandler(); },
        ];
    }
}
