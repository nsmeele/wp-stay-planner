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

    public static function getWeekdays(): array
    {
        global $wp_locale;
        return [
            $wp_locale->get_weekday(1),
            $wp_locale->get_weekday(2),
            $wp_locale->get_weekday(3),
            $wp_locale->get_weekday(4),
            $wp_locale->get_weekday(5),
            $wp_locale->get_weekday(6),
            $wp_locale->get_weekday(0),
        ];
    }

    public function makeCalendar(): string
    {
        $today          = new \DateTimeImmutable();
        $number_of_days = $today->format('t');
        $first_day      = new \DateTime('first day of ' . $today->format('F Y'));
        $last_day       = new \DateTime('last day of ' . $today->format('F Y'));
        $first_day_nr   = (int)$first_day->format('w');
        $last_day_nr    = (int)$last_day->format('w');

        /*
         * Get last month days
         */
        $clone                = clone $today;
        $prev_month           = $clone->modify('-1 month');
        $prev_month_day_count = $prev_month->format('t');

        if ($first_day_nr == 0) {
            $first_day_nr = 7;
        }

        ob_start();

//        echo '<h3><span class="me-1"><i class="fas fa-calendar-alt"></i></span>'.$date->format('F, Y').'</h3>';

        ?>

        <table>
            <thead>
            <tr>
                <?php
                $weekdays = self::getWeekDays();

                foreach ($weekdays as $weekday) {
                    echo '<th align="center">' . $weekday . '</th>';
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <tr>

                <?php
                $day_count    = 0;
                $day_break    = 6;
                $first_day_nr = $first_day_nr - 1;

                /*
                 * Get days from prev month
                 */
                for ($x = ($prev_month_day_count - $first_day_nr); $x < $prev_month_day_count; $x++) {
                    echo '<td></td>';

                    $day_count++;
                }

                /*
                 * Get current days
                 */
                for ($i = 1; $i <= $number_of_days; $i++) {
                    $date = new \DateTimeImmutable($today->format('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT));

                    echo '<td align="center">' . $i . '</td>';

                    if ($day_count == $day_break) {
                        echo '</tr><tr>';
                        $day_count = -1;
                    }

                    $day_count++;
                }

                /*
                 * Get days from next month
                 */
                $diff = 7 - $last_day_nr;
                if ($diff != 7) {
                    for ($y = 1; $y <= $diff; $y++) {
                        echo '<td ></td>';
                    }
                }
                ?>

            </tr>
            </tbody>

        </table>

        <?php
        return ob_get_clean();
    }
}
