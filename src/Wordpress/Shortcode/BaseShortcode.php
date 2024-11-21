<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Shortcode;

abstract class BaseShortcode
{
    public static function init(): void
    {
        $instance = new static();
        add_action('init', [$instance, 'register']);
    }

    final public function register(): void
    {
        add_shortcode($this->getTag(), [$this, 'render']);
    }

    abstract public function render(array $atts): string;

    abstract public function getTag(): string;
}
