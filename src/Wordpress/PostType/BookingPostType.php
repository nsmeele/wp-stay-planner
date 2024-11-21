<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

use Nsmeele\WpStayPlanner\Wordpress\FieldType\FieldFactory;

class BookingPostType extends BasePostType
{
    protected function getTag(): string
    {
        return 'booking';
    }

    public function registerPostType(): void
    {
        register_post_type(
            $this->getTag(),
            array_merge(
                $this->getDefaultProperties(),
                [
                    'labels' => [
                        'name'          => __('Boekingen', 'textdomain'),
                        'singular_name' => __('Boeking', 'textdomain'),
                        'add_new'       => 'Maak nieuwe boeking',
                        'add_new_item'  => 'Nieuwe boeking',
                        'edit_item'     => 'Wijzig boeking'
                    ],
                ]
            )
        );
    }

    public function getFields(): array
    {
        return [
            FieldFactory::create('date', 'start_date', [
                'label'    => __('Start datum', 'wp-stay-planner'),
                'required' => true,
            ]),
            FieldFactory::create('date', 'end_date', [
                'label'    => __('Eind datum', 'wp-stay-planner'),
                'required' => true,
            ]),
            FieldFactory::create('text', 'name', [
                'label'    => __('Naam', 'wp-stay-planner'),
                'required' => true,
            ]),
            FieldFactory::create('email', 'email', [
                'label'    => __('Email', 'wp-stay-planner'),
                'required' => true,
            ]),
            FieldFactory::create('text', 'phone', [
                'label'    => __('Telefoon', 'wp-stay-planner'),
                'required' => true,
            ]),
            FieldFactory::create('text', 'address', [
                'label'    => __('Adres', 'wp-stay-planner'),
                'required' => true,
            ]),
            FieldFactory::create('text', 'city', [
                'label'    => __('Plaats', 'wp-stay-planner'),
                'required' => true,
            ]),
            FieldFactory::create('text', 'zip', [
                'label'    => __('Postcode', 'wp-stay-planner'),
                'required' => true,
            ]),
            FieldFactory::create('text', 'country', [
                'label'    => __('Land', 'wp-stay-planner'),
                'required' => true,
            ]),
            FieldFactory::create('reference', 'room', [
                'label'         => __('Kamer', 'wp-stay-planner'),
                'required'      => true,
                'referenceArgs' => [
                    'post_type' => 'room',
                ],
            ]),
        ];
    }
}
