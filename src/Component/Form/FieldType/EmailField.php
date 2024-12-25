<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

class EmailField extends InputField
{
    public function __construct(
        ?string $name = null,
        array $args = array ()
    ) {
        parent::__construct($name, $args);
        $this->setWidgetAttribute('type', 'email');
    }

    public function getRegisterArgs(): array
    {
        return array_merge([
            parent::getRegisterArgs(),
            [
                'sanitize_callback' => 'sanitize_email',
            ]
        ]);
    }
}
