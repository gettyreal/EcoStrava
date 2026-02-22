<?php

class TransportRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("
            SELECT * FROM transports
        ");

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $transports = [];

        foreach ($rows as $row) {
            $transports[] = TransportMapper::fromDTO($row);
        }

        return $transports;
    }

    public function findById(int $id): Transport
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM transports WHERE id = ?
        ");

        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            throw new InvalidArgumentException("transport not found");
        }

        return TransportMapper::fromDTO($row);
    }
}
