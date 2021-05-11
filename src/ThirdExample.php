<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting;

use LukasLangen\Workshop\UnitTesting\Dependencies\EmailHelper;
use LukasLangen\Workshop\UnitTesting\Dependencies\PostParams;
use LukasLangen\Workshop\UnitTesting\Dependencies\UserRepository;
use PDO;
use function mail;

final class ThirdExample
{

    /**
     * @var EmailHelper|null
     */
    private $emailHelper;

    /**
     * @var UserRepository|null
     */
    private $userRepository;

    /**
     * @var PostParams|null
     */
    private $postParams;

    public function __construct(
        ?EmailHelper $emailHelper = null,
        ?UserRepository $userRepository = null,
        ?PostParams $postParams = null
    ) {
        $this->emailHelper = $emailHelper ?? new EmailHelper();
        $this->userRepository = $userRepository ?? UserRepository::createWithDefaultPDO();
        $this->postParams = $postParams ?? new PostParams();
    }

    // ... more code here

    public function updateEmailForUser(int $id): void
    {
        $user = $this->userRepository->getUser($id);
        if (!$user) {
            return;
        }

        $newEmail = $this->postParams->getParam('email');
        if ($newEmail === $user['email']) {
            return;
        }

        $this->userRepository->updateEmail($id, $newEmail);
        $this->emailHelper->sendEmailChangeSuccessfulMail($newEmail);
    }

    // Also used by a lot of other functions
    private function getDb(): PDO
    {
        return $this->userRepository->getPDO();
    }

    // ... more code here
}
