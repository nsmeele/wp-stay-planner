<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

use Nsmeele\WpStayPlanner\Component\Form\ElementFactory;

class RoomPostType extends AbstractPostType
{
    protected function getPostTypeProperties(): array
    {
        return array_merge(
            parent::getPostTypeProperties(),
            [
                'labels'       => [
                    'name'          => __('Kamers', 'textdomain'),
                    'singular_name' => __('Kamer', 'textdomain'),
                    'add_new'       => 'Maak nieuwe kamer',
                    'add_new_item'  => 'Nieuwe kamer',
                    'edit_item'     => 'Wijzig kamer'
                ],
                'public'       => true,
                'has_archive'  => false,
                'show_in_rest' => true,
                'supports'     => ['title', 'editor', 'thumbnail', 'excerpt'],
            ]
        );
    }

    public function getTag(): string
    {
        return 'room';
    }

    protected function getFields(): array
    {
        return [
            ElementFactory::create(name: 'description', args: [
                'label'    => __('Beschrijving', 'wp-stay-planner'),
                'required' => true,
            ]),
            ElementFactory::create(name: 'price', args: [
                'label'    => __('Prijs per nacht', 'wp-stay-planner'),
                'required' => true,
            ]),
            ElementFactory::create(name: 'capacity', args: [
                'label'    => __('Capaciteit', 'wp-stay-planner'),
                'required' => true,
            ]),
        ];
    }
}
