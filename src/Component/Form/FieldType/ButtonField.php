<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractElement;

class ButtonField extends AbstractElement
{
    public function __construct(?string $name = null, array $args = array ())
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
        return sprintf(
            '<button %s>%s</button>',
            $this->renderAttributes($this->getWidgetAttributes()),
            $this->getLabel(),
        );
    }
}
