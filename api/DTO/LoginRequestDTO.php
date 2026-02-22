<?php

class LoginRequestDTO
{
    private string $email;
    private string $password;

    public function __construct(array $data)
    {
        if (empty($data['email']) || empty($data['password'])) {
            throw new InvalidArgumentException("Email e password obbligatorie");
        }

        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
