<?php
final class CO2Value {
    private float $grams;

    public function __construct(float $grams) {

        if ($grams < 0) {
            throw new InvalidArgumentException("CO2 value must be positive or zero.");
        }

        $this->grams = $grams;
    }

    public function getGrams(): float {
        return $this->grams;
    }

    public function add(CO2Value $other): CO2Value {
        return new CO2Value($this->grams + $other->getGrams());
    }

    public function subtract(CO2Value $other): CO2Value {
        $result = $this->grams - $other->getGrams();
        return new CO2Value($result);
    }

    function __toString(): string {
        return (string)$this->grams . " g";
    }
}