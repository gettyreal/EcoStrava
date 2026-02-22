<?php

class ActivityCreateDTO
{
    // user_id preso dalla sessione
    private int $transportId;
    private float $distance;
    private string $date;

    public function __construct(array $data)
    {
        if (
            empty($data['transport_id']) ||
            empty($data['distance']) ||
            empty($data['date'])
        ) {
            throw new InvalidArgumentException("Campi obbligatori mancanti");
        }

        $this->transportId = (int)$data['transport_id'];
        $this->distance = (float)$data['distance'];
        $this->date = $data['date'];
    }

    public function getTransportId(): int
    {
        return $this->transportId;
    }

    public function getDistance(): float
    {
        return $this->distance;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}
