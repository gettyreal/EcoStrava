<?php

// richiama dati vari per la dashboard,
// da definire cosa si vuole ottenene.

class DashboardStatsDTO
{
    public float $totalDistance;
    public float $totalCo2Saved;
    public int $totalActivities;

    public function __construct(
        float $totalDistance,
        float $totalCo2Saved,
        int $totalActivities
    ) {
        $this->totalDistance = $totalDistance;
        $this->totalCo2Saved = $totalCo2Saved;
        $this->totalActivities = $totalActivities;
    }
}
