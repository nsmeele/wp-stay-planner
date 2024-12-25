<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractElement;

abstract class InputField extends AbstractElement
{
    protected function getWidgetHtml(): string
    {
        return sprintf(
            '<input %s>',
            $this->renderAttributes($this->getWidgetAttributes())
        );
    }

    public function getWidgetAttributes(): array
    {
        $arr            = parent::getWidgetAttributes();
        $arr[ 'value' ] = $this->getValue() ?? '';
        return $arr;
    }
}
