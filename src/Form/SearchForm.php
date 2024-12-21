<?php

namespace Nsmeele\WpStayPlanner\Form;

use Nsmeele\WpStayPlanner\Component\Form\AbstractForm;

class SearchForm extends AbstractForm
{
    public function getFields(): array
    {
        return [
            $this->createElement('date', 'start_date', [
                'label'    => __('Check-in', 'wp-stay-planner'),
                'required' => true,
            ]),
            $this->createElement('date', 'end_date', [
                'label'    => __('Check-out', 'wp-stay-planner'),
                'required' => true,
            ]),
            $this->createElement('number', 'rooms', [
                'label'    => __('Rooms', 'wp-stay-planner'),
                'required' => true,
            ]),
            $this->createElement('number', 'adults', [
                'label'    => __('Adults', 'wp-stay-planner'),
                'required' => true,
            ]),
            $this->createElement('number', 'children', [
                'label'    => __('Children', 'wp-stay-planner'),
                'required' => true,
            ]),
        ];
    }
}
