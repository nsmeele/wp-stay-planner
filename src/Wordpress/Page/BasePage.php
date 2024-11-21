<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Page;

abstract class BasePage
{
    public static function init(): void
    {
        $instance = new static();
        add_action('admin_menu', [$instance, 'register']);
    }

    abstract public function register(): void;

    abstract protected function render(): void;

    final public function execute(): void
    {
        $this->preRender();
        $this->render();
        $this->postRender();
    }

    protected function preRender(): void
    {
        echo '<div class="wrap">';
    }

    protected function postRender(): void
    {
        echo '</div>';
    }
}
