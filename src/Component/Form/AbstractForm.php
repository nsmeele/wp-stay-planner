<?php

namespace Nsmeele\WpStayPlanner\Component\Form;

abstract class AbstractForm extends AbstractContainer
{
    protected bool $renderSubmitButton = true;

    public function __construct(?string $name = null, array $args = array ())
    {
        $args[ 'widget_attributes' ] = array_merge([
            'method' => 'post',
            'action' => '',
        ], $args[ 'widget_attributes' ] ?? []);

        parent::__construct($name, $args);
    }

    public function setRenderSubmitButton(bool $renderSubmitButton): ContainerInterface
    {
        $this->renderSubmitButton = $renderSubmitButton;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            '<form %s>%s</form>',
            $this->renderWidgetAttributes(),
            $this->getWidgetHtml(),
        );
    }

    public function getWidgetHtml(): string
    {
        $html = parent::getWidgetHtml();

        if ($this->renderSubmitButton) {
            $html .= $this->createElement('submit', 'submit')->__toString();
        }

        return $html;
    }
}
