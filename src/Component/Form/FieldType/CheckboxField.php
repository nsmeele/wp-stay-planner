<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

class CheckboxField extends InputField
{
    public function __construct(
        ?string $name = null,
        array $args = [],
    ) {
        parent::__construct($name, $args);
        $this->setWidgetAttribute('type', 'checkbox');
    }
}
