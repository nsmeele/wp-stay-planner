<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

interface PostTypeInterface
{
    public function init(): void;

    public function getTag(): string;

    public function register(): void;
}
