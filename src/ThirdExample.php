<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting;

use PDO;
use function mail;

final class ThirdExample
{
    // ... more code here

    public function updateEmailForUser(int $id): void
    {
        $user = $this->getDb()->query("SELECT * FROM users WHERE id = %id")->fetch(PDO::FETCH_ASSOC);

        // User exists?
        if (!$user) {
            return;
        }

        $newEmail = $_POST['email'];

        if ($newEmail === $user['email']) {
            return;
        }

        $this->getDb()->exec("UPDATE user SET email=$newEmail WHERE id = $id");

        if (!mail($newEmail, 'Email change successful', 'Your email change was successful')) {
            throw new \Exception('Could not send email');
        }
    }

    // Also used by a lot of other functions
    private function getDb(): PDO
    {
        return new PDO('some-dsn');
    }

    // ... more code here
}
