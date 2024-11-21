<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Taxonomy;

abstract class BaseTaxonomy
{
    public static function init(): void
    {
        $instance = new static();
        add_action('init', [$instance, 'register']);
    }

    abstract public function register(): void;
}
