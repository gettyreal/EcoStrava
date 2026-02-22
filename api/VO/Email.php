<?php
final class Email
{
    private string $value;

    public function __construct(string $email)
    {
        // Validazione formato email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Formato email non valido: $email");
        }

        // Normalizzazione: minuscolo
        $this->value = strtolower($email);
    }

    // Restituisce il valore della email
    public function value(): string
    {
        return $this->value;
    }

    // Confronto tra VO
    public function equals(Email $other): bool
    {
        return $this->value === $other->value();
    }
}
