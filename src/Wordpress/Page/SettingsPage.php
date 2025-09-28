<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Page;

class SettingsPage extends BasePage
{
    public function register(): void
    {
        add_submenu_page(
            'stay-planner',
            __('Settings', 'wp-stay-planner'),
            __('Settings', 'wp-stay-planner'),
            'manage_options',
            'stay-planner-settings',
            [$this, 'execute']
        );
    }

    protected function render(): void
    {
        echo 'All aboard!';
    }
}
