<?php
final class Date {
    private DateTimeImmutable $dateTime;

    public function __construct(string $dateString) {
        // Try common date formats (Y-m-d, Y-m-d H:i:s), then fallback to DateTime parsing
        $dt = DateTimeImmutable::createFromFormat('Y-m-d', $dateString);
        if (!$dt) {
            $dt = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $dateString);
        }
        if (!$dt) {
            try {
                $dt = new DateTimeImmutable($dateString);
            } catch (Exception $e) {
                $dt = false;
            }
        }

        if (!$dt) {
            throw new InvalidArgumentException("Invalid date format: expected Y-m-d or ISO datetime");
        }

        $this->dateTime = $dt;
    }

    public function getDate(): DateTimeImmutable {
        return $this->dateTime;
    }

    public function isPast(): bool {
        return $this->dateTime < new DateTimeImmutable('today');
    }

    public function format(): string {
        return $this->dateTime->format('Y-m-d');
    }

    public function formatWith(string $fmt): string {
        return $this->dateTime->format($fmt);
    }

    function __toString(): string {
        return $this->dateTime->format(DateTime::ATOM);
    }
}