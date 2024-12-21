<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractElement;

class TextField extends AbstractElement
{
    protected function getWidgetHtml(): string
    {
        return sprintf(
            '<input type="text" %s>',
            $this->renderWidgetAttributes()
        );
    }
}
