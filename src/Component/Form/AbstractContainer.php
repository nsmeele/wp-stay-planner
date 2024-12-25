<?php

namespace Nsmeele\WpStayPlanner\Component\Form;

abstract class AbstractContainer extends AbstractElement implements ContainerInterface
{
    protected array $values = [];

    public function setValues(array $values = array ()): ContainerInterface
    {
        $this->values = $values;
        return $this;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function createElement(
        string $type,
        ?string $name = null,
        array $args = array ()
    ): ElementInterface {
        $field = ElementFactory::create($type, $name, $args);
        $field->setContainer($this);
        return $field;
    }

    public function getWidgetHtml(): string
    {
        $html = '';
        $values = $this->getValues();
        foreach ($this->getFields() as $field) {
            $field->setValue($values[ $field->getName() ] ?? null);
            $html .= $field->__toString();
        }
        return $html;
    }

    protected function getDefaultContainerAttr(): array
    {
        return [
            'class' => 'element__container'
        ];
    }
}
