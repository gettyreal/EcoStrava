<?php

class ActivityResponseDTO
{
    public int $id;
    public float $distance;
    public string $date;
    public int $user_id;
    public int $transport_id;

    public function __construct(int $id, float $distance, string $date, int $user_id, int $transport_id)
    {
        $this->id = $id;
        $this->distance = $distance;
        $this->date = $date;
        $this->user_id = $user_id;
        $this->transport_id = $transport_id;
    }
}
