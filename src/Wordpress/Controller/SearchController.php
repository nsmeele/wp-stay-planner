<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Controller;

class SearchController extends AbstractController
{
    protected function getUri(): string
    {
        return 'search-room';
    }

    protected function getTemplate(): string
    {
        return 'search.php';
    }

    protected function getBlockTemplateArguments(): array
    {
        return array_merge(
            parent::getBlockTemplateArguments(),
            [
                'title' => __('Search room page', 'wp-stay-planner'),
                'description' => __('A search result page template', 'wp-stay-planner'),
            ]
        );
    }
}
