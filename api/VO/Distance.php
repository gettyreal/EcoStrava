<?php
final class Distance {
    private float $kilometers;

    public function __construct(float $kilometers) {

        if ($kilometers < 0) {
            throw new InvalidArgumentException("Distance must be positive or zero.");
        }

        $this->kilometers = $kilometers;
    }

    public function getKilometers(): float {
        return $this->kilometers;
    }

    public function add(Distance $other): Distance {
        return new Distance($this->kilometers + $other->getKilometers());
    }

    public function subtract(Distance $other): Distance {
        $result = $this->kilometers - $other->getKilometers();
        return new Distance($result);
    }

    function __toString(): string {
        return (string)$this->kilometers . " km";
    }
}