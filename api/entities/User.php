<?php
class User
{
    private ?int $id;
    private string $username;
    private Email $email;
    private string $password;
    private ?Date $created_at;
    
    public function __construct(?int $id, string $username, Email $email, string $password, ?Date $created_at)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): ?Date
    {
        return $this->created_at;
    }
}