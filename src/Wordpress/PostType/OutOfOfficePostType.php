<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

class OutOfOfficePostType extends BasePostType
{
    public function registerPostType(): void
    {
        register_post_type(
            $this->getTag(),
            array_merge(
                $this->getDefaultProperties(),
                [
                    'labels' => [
                        'name' => __('Out of office', 'textdomain'),
                        'singular_name' => __('Out of office', 'textdomain'),
                        'add_new' => 'Add new out of office',
                        'add_new_item' => 'Nieuwe out of office',
                        'edit_item' => 'Bewerk out of office'
                    ],
                ]
            )
        );
    }

    protected function getTag(): string
    {
        return 'out_of_office';
    }
}
