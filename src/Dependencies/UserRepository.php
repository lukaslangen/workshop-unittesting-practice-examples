<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Dependencies;

use PDO;

class UserRepository
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function createWithDefaultPDO(): self
    {
        return new self(new PDO('some-dsn'));
    }

    /**
     * @return bool|array
     */
    public function getUser(int $id)
    {
        return $this->pdo->query("SELECT * FROM users WHERE id = %id")->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEmail(int $id, string $email): bool
    {
        $result = $this->pdo->exec("UPDATE user SET email=$newEmail WHERE id = $id");

        return $result !== false;
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
