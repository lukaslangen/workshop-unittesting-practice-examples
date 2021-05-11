<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Test\Shared;

use LukasLangen\Workshop\UnitTesting\Dependencies\PostParams;
use PHPUnit\Framework\TestCase;

final class PostParamsDoubleFactory
{
    public static function createDummy(): PostParams
    {
        return new class extends PostParams {
            public function getParam(string $name) {}
        };
    }

    public static function createStub(TestCase $testCase)
    {
        return self::createMock($testCase);
    }

    public static function createMock(TestCase $testCase)
    {
        return $testCase->getMockBuilder(PostParams::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
    }
}
