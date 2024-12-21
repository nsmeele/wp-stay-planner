<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

class OutOfOfficePostType extends BasePostType
{
    protected function getPostTypeProperties(): array
    {
        return array_merge(
            parent::getPostTypeProperties(),
            [
                'labels' => [
                    'name' => __('Out of office', 'textdomain'),
                    'singular_name' => __('Out of office', 'textdomain'),
                    'add_new' => 'Add new out of office',
                    'add_new_item' => 'Nieuwe out of office',
                    'edit_item' => 'Bewerk out of office'
                ],
            ]
        );
    }

    public function getTag(): string
    {
        return 'out_of_office';
    }
}
