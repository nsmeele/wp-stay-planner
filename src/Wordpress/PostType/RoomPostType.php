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
                'labels' => [
                    'name' => __('Kamers', 'textdomain'),
                    'singular_name' => __('Kamer', 'textdomain'),
                    'add_new' => 'Maak nieuwe kamer',
                    'add_new_item' => 'Nieuwe kamer',
                    'edit_item' => 'Wijzig kamer'
                ],
                'public' => true,
                'supports' => ['title', 'editor', 'thumbnail',],
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
            ElementFactory::create('text', 'price', [
                'label' => __('Prijs per nacht', 'textdomain'),
                'required' => true,
            ]),
            ElementFactory::create('text', 'capacity', [
                'label' => __('Capaciteit', 'textdomain'),
                'required' => true,
            ]),
            ElementFactory::create('text', 'description', [
                'label' => __('Beschrijving', 'textdomain'),
                'required' => true,
            ]),
        ];
    }
}
