<?php

namespace Nsmeele\WpStayPlanner\Wordpress\FieldType;

class TextField extends BaseField
{
    protected function getWidgetHtml(): string
    {
        return sprintf(
            '<input type="text" %s>',
            $this->renderWidgetAttributes()
        );
    }
}
