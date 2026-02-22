<?php
class Transport
{
    private int $id;
    private string $name;
    private CO2Value $co2Value;

    public function __construct(int $id, string $name, CO2Value $co2Value)
    {
        $this->id = $id;
        $this->name = $name;
        $this->co2Value = $co2Value;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCo2Value(): CO2Value
    {
        return $this->co2Value;
    }
}