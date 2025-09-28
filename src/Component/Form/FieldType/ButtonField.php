<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractElement;
use Nsmeele\WpStayPlanner\Component\HTMLElement;

class ButtonField extends AbstractElement
{
    public function __construct(?string $name = null, array $args = [])
    {
        parent::__construct($name, $args);
        $this->setWidgetAttribute('type', 'button');
    }

    public function renderLabel(): string
    {
        return '';
    }

    protected function getWidgetHtml(): string
    {
        return new HTMLElement(
            'button',
            $this->getWidgetAttributes(),
            $this->getLabel(),
        );
    }
}
