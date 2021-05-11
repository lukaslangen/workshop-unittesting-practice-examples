<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Dependencies;

use function mail;

class EmailHelper
{
    public function sendEmailChangeSuccessfulMail(string $email): void
    {
        $successful = mail($email, 'Email change successful', 'Your email change was successful');

        if ($successful) {
            return;
        }

        throw new \Exception('Could not send email');
    }
}
