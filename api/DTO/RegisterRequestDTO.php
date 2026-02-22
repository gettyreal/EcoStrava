<?php
class RegisterRequestDTO
{
    private string $email;
    private string $password;
    private string $username;

    public function __construct(array $data)
    {
        if (
            empty($data['email']) ||
            empty($data['password']) ||
            empty($data['username'])
        ) {
            throw new InvalidArgumentException("Campi obbligatori mancanti");
        }

        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->username = $data['username'];
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}
