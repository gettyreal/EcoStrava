<?php

class ActivityMapper
{
    public static function fromDTO(array $row): Activity
    {
        return new Activity(
            $row['id'],
            new Distance($row['distance']),
            new Date($row['date']),
            $row['user_id'],
            $row['transport_id'],
        );
    }

    public static function toDTO(Activity $activity): array
    {
        return [
            'id' => $activity->getId(),
            'user_id' => $activity->getUserId(),
            'transport_id' => $activity->getTransportId(),
            'distance' => $activity->getDistance()->getKilometers(),
            'date' => $activity->getCreatedAt()->format()
        ];
    }
}
