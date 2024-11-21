<?php

namespace Nsmeele\WpStayPlanner\Wordpress\FieldType;

class EmailField extends BaseField
{
    protected function getRegisterArgs(): array
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
