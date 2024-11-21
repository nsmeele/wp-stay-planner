<?php

namespace Nsmeele\WpStayPlanner\Wordpress\FieldType;

interface FieldInterface
{
    public function register(): void;

    public function __toString(): string;
}
