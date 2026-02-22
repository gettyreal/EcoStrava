<?php

class DashboardController
{
    private ActivityRepository $activityRepo;

    public function __construct(ActivityRepository $activityRepo)
    {
        $this->activityRepo = $activityRepo;
    }

    /*
    public function stats()
    {
        requireAuth();

        $userId = $_SESSION['user_id'];

        $stats = $this->activityRepo->getStatsByUser($userId);

        $dto = new DashboardStatsDTO(
            (float)($stats['total_distance'] ?? 0),
            (float)($stats['total_co2'] ?? 0),
            (int)($stats['total_activities'] ?? 0)
        );

        echo json_encode($dto);
    } */
}
