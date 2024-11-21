<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

use Nsmeele\WpStayPlanner\Wordpress\FieldType\FieldFactory;

class RoomPostType extends BasePostType
{
    public function registerPostType(): void
    {
        register_post_type(
            $this->getTag(),
            array_merge(
                $this->getDefaultProperties(),
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
            )
        );
    }

    protected function getTag(): string
    {
        return 'room';
    }

    protected function getFields(): array
    {
        return [
            FieldFactory::create('text', 'price', [
                'label' => __('Prijs per nacht', 'textdomain'),
                'required' => true,
            ]),
            FieldFactory::create('text', 'capacity', [
                'label' => __('Capaciteit', 'textdomain'),
                'required' => true,
            ]),
            FieldFactory::create('text', 'description', [
                'label' => __('Beschrijving', 'textdomain'),
                'required' => true,
            ]),
        ];
    }
}
