<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

class OfferPostType extends AbstractPostType
{
    public function getTag(): string
    {
        return 'offer';
    }

    protected function getPostTypeProperties(): array
    {
        return array_merge(
            parent::getPostTypeProperties(),
            [
                'labels' => [
                    'name' => __('Aanbiedingen', 'textdomain'),
                    'singular_name' => __('Aanbieding', 'textdomain'),
                    'add_new' => 'Maak nieuwe aanbieding',
                    'add_new_item' => 'Nieuwe aanbieding',
                    'edit_item' => 'Wijzig aanbieding'
                ],
            ]
        );
    }
}
