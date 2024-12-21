<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

class SubmitField extends ButtonField
{
    public function __construct(?string $name = null, array $args = array ())
    {
        $args[ 'label' ] = $args[ 'label' ] ?? 'Submit';
        $args[ 'value' ] = $args[ 'value' ] ?? 'submit';

        parent::__construct($name, $args);
        $this->setWidgetAttribute('type', 'submit');
    }
}
