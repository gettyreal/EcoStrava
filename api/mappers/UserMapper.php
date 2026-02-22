<?php

class UserMapper
{
    public static function fromDTO(array $row): User
    {
        $id = $row['id'] ?? $row['ID'] ?? $row['Id'] ?? null;
        return new User(
            $id,
            $row['username'] ?? $row['name'] ?? '',
            new Email($row['email']),
            $row['password'],
            isset($row['created_at']) && $row['created_at'] !== null && $row['created_at'] !== '' ? new Date($row['created_at']) : null
        );
    }

    public static function toDTO(User $user): array
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail()->value(),
            'password' => $user->getPassword(),
            'username' => $user->getUsername(),
            'created_at' => $user->getCreatedAt() ? $user->getCreatedAt()->format() : null
        ];
    }
}
