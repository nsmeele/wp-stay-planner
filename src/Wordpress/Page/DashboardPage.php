<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Page;

class DashboardPage extends BasePage
{
    public function register(): void
    {
        add_menu_page(
            'WP Stay Planner',
            'WP Stay Planner',
            'manage_options',
            'stay-planner',
            [$this, 'execute']
        );

        add_submenu_page(
            'stay-planner',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'stay-planner',
            [$this, 'execute']
        );
    }

    protected function render(): void
    {
        echo 'Hello world!';
        echo do_shortcode('[calendar]');
    }
}
