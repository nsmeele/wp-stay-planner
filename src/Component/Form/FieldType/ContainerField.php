<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractForm;

class ContainerField extends AbstractForm
{
    protected array $fields;

    public function __toString(): string
    {
        return sprintf(
            '<div %s>%s</div>',
            $this->renderAttributes($this->getWidgetAttributes()),
            $this->getWidgetHtml(),
        );
    }

    public function getWidgetHtml(): string
    {
        $html = '';

        foreach ($this->fields as $field) {
            $html .= $field->__toString();
        }

        return $html;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
