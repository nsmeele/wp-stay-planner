<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

use Nsmeele\WpStayPlanner\Component\Form\ElementFactory;

class BookingPostType extends AbstractPostType
{
    public function getTag(): string
    {
        return 'booking';
    }

    public function getPostTypeProperties(): array
    {
        return array_merge(
            parent::getPostTypeProperties(),
            [
                'labels' => [
                    'name' => __('Boekingen', 'textdomain'),
                    'singular_name' => __('Boeking', 'textdomain'),
                    'add_new' => 'Maak nieuwe boeking',
                    'add_new_item' => 'Nieuwe boeking',
                    'edit_item' => 'Wijzig boeking'
                ],
            ]
        );
    }

    public function getFields(): array
    {
        return [
            ElementFactory::create('date', 'start_date', [
                'label'    => __('Aankomstdatum', 'wp-stay-planner'),
                'required' => true,
            ]),
            ElementFactory::create('date', 'end_date', [
                'label'    => __('Vertrekdatum', 'wp-stay-planner'),
                'required' => true,
            ]),
            ElementFactory::create('text', 'name', [
                'label'    => __('Naam', 'wp-stay-planner'),
                'required' => true,
            ]),
            ElementFactory::create('email', 'email', [
                'label'    => __('Email', 'wp-stay-planner'),
                'required' => true,
            ]),
            ElementFactory::create('text', 'phone', [
                'label'    => __('Telefoon', 'wp-stay-planner'),
                'required' => true,
            ]),
            ElementFactory::create('text', 'address', [
                'label'    => __('Adres', 'wp-stay-planner'),
                'required' => true,
            ]),
            ElementFactory::create('text', 'city', [
                'label'    => __('Plaats', 'wp-stay-planner'),
                'required' => true,
            ]),
            ElementFactory::create('text', 'zip', [
                'label'    => __('Postcode', 'wp-stay-planner'),
                'required' => true,
            ]),
            ElementFactory::create('select', 'country', [
                'label'    => __('Land', 'wp-stay-planner'),
                'required' => true,
                'options'  => [
                    // list countries here
                ]
            ]),
            ElementFactory::create('reference', 'room', [
                'label'         => __('Kamer', 'wp-stay-planner'),
                'required'      => true,
                'referenceArgs' => [
                    'post_type' => 'room',
                ],
            ]),
        ];
    }
}
