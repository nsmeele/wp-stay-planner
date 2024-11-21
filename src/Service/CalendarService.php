<?php

namespace Nsmeele\WpStayPlanner\Service;

class CalendarService
{
    protected static array $reservationCache = [];

    protected static CalendarService $instance;

    public function __construct()
    {
    }

    public static function getInstance(): static
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function getReservationCache(): array
    {
        return self::$reservationCache;
    }

    public function setReservationCache(array $reservationCache): static
    {
        self::$reservationCache = $reservationCache;
        return $this;
    }

    public function renderMonth(): void
    {
    }

    public function renderDay(): void
    {
    }

    public function renderYear(): void
    {
    }

    private function resolveYear(int $year): string
    {
        $str = '';

        for ($m = 1; $m <= 12; $m++) {
            for ($d = 1; $d <= 31; $d++) {
                $date = new \DateTimeImmutable(sprintf('%d-%d-%d', $year, $m, $d));
                $str  .= sprintf('%d %d %s', $m, $d, $date->format('d-m-Y')) . '<br>';
            }
        }

        return $str;
    }
}
