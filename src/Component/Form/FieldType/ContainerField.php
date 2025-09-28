<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractContainer;
use Nsmeele\WpStayPlanner\Component\HTMLElement;

class ContainerField extends AbstractContainer
{
    public function __toString(): string
    {
        return (string)new HTMLElement(
            'div',
            [
                'class' => 'form__container',
            ],
            $this->getWidgetHtml(),
        );
    }

    public function getWidgetHtml(): string
    {
        return implode('', $this->getFields());
    }
}
