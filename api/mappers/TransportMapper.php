<?php

class TransportMapper
{
    public static function fromDTO(array $row): Transport
    {
        return new Transport(
            $row['id'] ?? null,
            $row['name'],
            $row['co2_per_km']
        );
    }

    public static function toDTO(Transport $transport): array
    {
        return [
            'id' => $transport->getId(),
            'name' => $transport->getName(),
            'co2_per_km' => $transport->getCo2Value()->getGrams()
        ];
    }
}
