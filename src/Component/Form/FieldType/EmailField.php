<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractElement;

class EmailField extends AbstractElement
{
    public function getRegisterArgs(): array
    {
        return array_merge([
            parent::getRegisterArgs(),
            [
                'sanitize_callback' => 'sanitize_email',
            ]
        ]);
    }

    protected function getWidgetHtml(): string
    {
        return sprintf(
            '<input type="email" %s>',
            $this->renderWidgetAttributes()
        );
    }
}
