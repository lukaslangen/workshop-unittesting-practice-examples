<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Test\Shared;

use LukasLangen\Workshop\UnitTesting\Dependencies\UserRepository;
use PHPUnit\Framework\TestCase;

final class UserRepositoryDoubleFactory
{

    public static function createDummy(): UserRepository
    {
        return new class extends UserRepository {
            public function getUser(int $id) {}
            public function updateEmail(int $id, string $email): bool { return true; }
        };
    }

    public static function createStub(TestCase $testCase)
    {
        return self::createMock($testCase);
    }

    public static function createMock(TestCase $testCase)
    {
        return $testCase->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
    }
}
