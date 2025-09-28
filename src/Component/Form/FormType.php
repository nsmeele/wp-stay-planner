<?php

namespace Nsmeele\WpStayPlanner\Component\Form;

use Nsmeele\WpStayPlanner\Component\Form\FieldType\ContainerField;
use Nsmeele\WpStayPlanner\Component\HTMLElement;

class FormType extends ContainerField
{
    protected bool $renderSubmitButton = true;

    protected ?string $submitLabel;

    public function __construct(
        protected ?string $name = null,
        protected array $attributes = [],
    ) {
        $this->attributes[ 'name' ]   ??= $this->name;
        $this->attributes[ 'id' ]     ??= $this->name;
        $this->attributes[ 'method' ] ??= 'post';
        $this->attributes[ 'action' ] ??= '';
    }

    protected function setSubmitLabel(?string $label): ContainerInterface
    {
        $this->submitLabel = $label;
        return $this;
    }

    public function setRenderSubmitButton(bool $renderSubmitButton): ContainerInterface
    {
        $this->renderSubmitButton = $renderSubmitButton;
        return $this;
    }

    public function __toString(): string
    {
        return (string)new HTMLElement(
            'form',
            $this->attributes,
            $this->getWidgetHtml(),
        );
    }

    public function getWidgetHtml(): string
    {
        $html = parent::getWidgetHtml();

        if ($this->renderSubmitButton) {
            $html .= $this->createElement(
                'submit',
                'submit',
                ['label' => $this->submitLabel ?? __('Submit', 'wp-stay-planner')]
            );
        }

        return $html;
    }
}
