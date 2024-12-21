<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractElement;

class CheckboxField extends AbstractElement
{
    protected function getWidgetHtml(): string
    {
        return sprintf(
            '<input type="checkbox" %s>',
            $this->renderWidgetAttributes()
        );
    }
}
