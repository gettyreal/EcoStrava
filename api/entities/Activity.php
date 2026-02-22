<?php
class Activity
{
    private int $id;
    private Distance $distance;
    private Date $created_at;
    private int $user_id;
    private int $transport_id;

    public function __construct(int $id, Distance $distance, Date $created_at, int $user_id, int $transport_id)
    {
        $this->id = $id;
        $this->distance = $distance;
        $this->created_at = $created_at;
        $this->user_id = $user_id;
        $this->transport_id = $transport_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDistance(): Distance
    {
        return $this->distance;
    }

    public function getCreatedAt(): Date
    {
        return $this->created_at;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getTransportId(): int
    {
        return $this->transport_id;
    }
}