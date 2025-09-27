<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

interface PostTypeInterface
{
    public function init(): void;

    public function adminMenuSelected(string $parentFile): string;

    public function getTag(): string;

    public function register(): void;

    public function registerPostType(): void;

    public function addToMenu($parentSlug = 'stay-planner'): void;

    public function registerMetabox(): void;

    public function saveMetaboxData(int $postId): void;

    public function renderMetabox($post): void;
}
