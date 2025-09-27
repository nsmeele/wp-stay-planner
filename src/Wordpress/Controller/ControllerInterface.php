<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Controller;

interface ControllerInterface
{
    public function renderTemplate(): void;

    public function registerQueryVar(array $vars): array;

    public function registerUri(): void;

    public function getQueryVar(): string;

    public static function init(): void;
}
