<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Shortcode;

use Nsmeele\WpStayPlanner\Service\CalendarService;

class CalendarShortcode extends BaseShortcode
{
    public function getTag(): string
    {
        return 'calendar';
    }

    public function render(array $atts): string
    {
        $year = date('Y');

        $calendarService = new CalendarService();
        $schema          = $calendarService->renderYear();

        return '<h1>Calendar</h1>' . $schema;
    }
}
