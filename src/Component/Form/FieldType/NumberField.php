<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

class NumberField extends InputField
{
    public function __construct(
        ?string $name = null,
        array $args = array ()
    ) {
        parent::__construct($name, $args);
        $this->setWidgetAttribute('type', 'number');
    }
}
