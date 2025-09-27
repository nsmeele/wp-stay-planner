<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractElement;

class RepeaterField extends AbstractElement
{
    protected function getWidgetHtml(): string
    {
        return '<h1>Repeater</h1>';
    }
}
