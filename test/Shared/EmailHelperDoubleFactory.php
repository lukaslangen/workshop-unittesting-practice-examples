<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Test\Shared;

use LukasLangen\Workshop\UnitTesting\Dependencies\EmailHelper;
use PHPUnit\Framework\TestCase;

final class EmailHelperDoubleFactory
{
    public static function createDummy(): EmailHelper
    {
        return new class extends EmailHelper {
            public function sendEmailChangeSuccessfulMail(string $email): void {}
        };
    }

    public static function createMock(TestCase $testCase)
    {
        return $testCase->getMockBuilder(EmailHelper::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
    }
}
