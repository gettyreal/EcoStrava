<?php

class UserRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(User $user): int
{
    $stmt = $this->pdo->prepare("
            INSERT INTO users (username, email, password, created_at)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
            $user->getUsername(),
            $user->getEmail()->value(),
            $user->getPassword(),
            $user->getCreatedAt() ? $user->getCreatedAt()->formatWith('Y-m-d H:i:s') : (new DateTimeImmutable())->format('Y-m-d H:i:s')
    ]);

    return (int)$this->pdo->lastInsertId();
}


    public function findByEmail(string $email): ?User
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM users WHERE email = ?
        ");

        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return UserMapper::fromDTO($row);
    }

    public function findById(int $id): User
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM users WHERE id = ?
        ");

        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            throw new InvalidArgumentException("user not found");
        }

        return UserMapper::fromDTO($row);
    }
}
