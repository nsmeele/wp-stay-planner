<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

class SeasonPostType extends BasePostType
{
    protected function getPostTypeProperties(): array
    {
        return array_merge(
            parent::getPostTypeProperties(),
            [
                'labels'  => [
                    'name' => __('Seizoenen', 'textdomain'),
                    'singular_name' => __('Seizoen', 'textdomain'),
                    'add_new' => 'Voeg nieuw seizoen toe',
                    'add_new_item' => 'Nieuw seizoen',
                    'edit_item' => 'Bewerk seizoen',
                ],
                'public'  => false,
                'show_ui' => true,
            ]
        );
    }

    public function getTag(): string
    {
        return 'season';
    }
}
