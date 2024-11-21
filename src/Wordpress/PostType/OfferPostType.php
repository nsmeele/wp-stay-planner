<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

class OfferPostType extends BasePostType
{
    protected function getTag(): string
    {
        return 'offer';
    }

    public function registerPostType(): void
    {
        register_post_type(
            $this->getTag(),
            array_merge(
                $this->getDefaultProperties(),
                [
                    'labels' => [
                        'name' => __('Aanbiedingen', 'textdomain'),
                        'singular_name' => __('Aanbieding', 'textdomain'),
                        'add_new' => 'Maak nieuwe aanbieding',
                        'add_new_item' => 'Nieuwe aanbieding',
                        'edit_item' => 'Wijzig aanbieding'
                    ],
                ]
            )
        );
    }
}
