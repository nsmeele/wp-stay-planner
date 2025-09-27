<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractElement;
use Nsmeele\WpStayPlanner\Component\HTMLElement;

abstract class InputField extends AbstractElement
{
    protected function getWidgetHtml(): string
    {
        return new HTMLElement(
            'input',
            $this->getWidgetAttributes()
        );
    }

    public function getWidgetAttributes(): array
    {
        $arr            = parent::getWidgetAttributes();
        $arr[ 'value' ] = $this->getValue() ?? '';
        return $arr;
    }
}
