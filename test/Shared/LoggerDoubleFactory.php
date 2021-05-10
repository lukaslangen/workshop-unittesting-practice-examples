<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Test\Shared;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

final class LoggerDoubleFactory
{
    public static function createDummy(): LoggerInterface
    {
        return new class implements LoggerInterface {
            public function emergency($message, array $context = []) {}
            public function alert($message, array $context = []) {}
            public function critical($message, array $context = []) {}
            public function error($message, array $context = []) {}
            public function warning($message, array $context = []) {}
            public function notice($message, array $context = []) {}
            public function info($message, array $context = []) {}
            public function debug($message, array $context = []) {}
            public function log($level, $message, array $context = []) {}
        };
    }

    public static function createMock(TestCase $testCase)
    {
        return $testCase->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
    }
}
