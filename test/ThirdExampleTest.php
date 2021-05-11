<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Test;

use LukasLangen\Workshop\UnitTesting\Dependencies\EmailHelper;
use LukasLangen\Workshop\UnitTesting\Dependencies\PostParams;
use LukasLangen\Workshop\UnitTesting\Dependencies\UserRepository;
use LukasLangen\Workshop\UnitTesting\Test\Shared\EmailHelperDoubleFactory;
use LukasLangen\Workshop\UnitTesting\Test\Shared\PostParamsDoubleFactory;
use LukasLangen\Workshop\UnitTesting\Test\Shared\UserRepositoryDoubleFactory;
use LukasLangen\Workshop\UnitTesting\ThirdExample;
use PHPUnit\Framework\TestCase;

final class ThirdExampleTest extends TestCase
{
    /** @test */
    public function doesNothingIfUserDoesntExist(): void
    {
        $emailHelper = EmailHelperDoubleFactory::createMock($this);
        $emailHelper->expects($this->never())->method('sendEmailChangeSuccessfulMail');

        $postParams = PostParamsDoubleFactory::createMock($this);
        $postParams->expects($this->never())->method('getParam');

        $repository = UserRepositoryDoubleFactory::createMock($this);
        $repository->expects($this->never())->method('updateEmail');
        $repository->method('getUser')->willReturn(false);

        $sut = $this->getSut($emailHelper, $repository, $postParams);
        $sut->updateEmailForUser(1234);
    }

    private function getSut(
        ?EmailHelper $emailHelper = null,
        ?UserRepository $userRepository = null,
        ?PostParams $postParams = null
    ): ThirdExample {
        return new ThirdExample(
            $emailHelper ?? EmailHelperDoubleFactory::createDummy(),
            $userRepository ?? UserRepositoryDoubleFactory::createDummy(),
            $postParams ?? PostParamsDoubleFactory::createDummy()
        );
    }
}
