<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

class SeasonPostType extends BasePostType
{
    public function registerPostType(): void
    {
        register_post_type(
            $this->getTag(),
            array_merge(
                $this->getDefaultProperties(),
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
            )
        );
    }

    protected function getTag(): string
    {
        return 'season';
    }
}
