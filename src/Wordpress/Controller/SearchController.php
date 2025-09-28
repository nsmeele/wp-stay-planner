<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Controller;

class SearchController extends AbstractController
{
    protected function getUri(): string
    {
        return 'search-room';
    }

    public function getTemplate(): string
    {
        return 'parts/search-room.php';
    }

}
