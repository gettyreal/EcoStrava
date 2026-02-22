<?php

class ActivityRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(Activity $activity): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO activities (user_id, transport_id, distance, date)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([
            $activity->getUserId(),
            $activity->getTransportId(),
            $activity->getDistance(),
            $activity->getCreatedAt()
        ]);

        return (int)$this->pdo->lastInsertId();
    }

    public function findByUserId(int $userId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM activities
            WHERE user_id = ?
            ORDER BY date DESC
        ");

        $stmt->execute([$userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $activities = [];

        foreach ($rows as $row) {
            $activities[] = ActivityMapper::fromDTO($row);
        }

        return $activities;
    }

    public function deleteByIdAndUser(int $id, int $userId): void
    {
        $stmt = $this->pdo->prepare("
            DELETE FROM activities
            WHERE id = ? AND user_id = ?
        ");

        $stmt->execute([$id, $userId]);
    }
}
