<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractElement;

class NumberField extends AbstractElement
{
    protected function getWidgetHtml(): string
    {
        return sprintf(
            '<input type="number" %s>',
            $this->renderWidgetAttributes()
        );
    }
}
