<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Shortcode;

class RoomsShortcode extends BaseShortcode
{
    public function render(array $atts): string
    {
        return 'Rooms';
    }

    public function getTag(): string
    {
        return 'rooms';
    }
}
