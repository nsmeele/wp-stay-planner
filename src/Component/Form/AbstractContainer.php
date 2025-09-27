<?php

namespace Nsmeele\WpStayPlanner\Component\Form;

abstract class AbstractContainer implements ContainerInterface
{
    protected array $fields = [];

    protected array $values = [];

    protected array $attributes = [];

    public function setValues(array $values = []): ContainerInterface
    {
        $this->values = $values;
        return $this;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function getWidgetHtml(): string
    {
        $html   = '';
        $values = $this->getValues();
        foreach ($this->getFields() as $field) {
            $field->setValue($values[ $field->getName() ] ?? null);
            $html .= $field;
        }
        return $html;
    }

    protected function getDefaultContainerAttr(): array
    {
        return [
            'class' => 'element__container'
        ];
    }

    public function createElement(
        string $type,
        ?string $name = null,
        array $args = []
    ): ElementInterface {
        $field = ElementFactory::create($type, $name, $args);
        $field->setContainer($this);
        $id = $field->getId() ?? $this->generateId($name);
        $field->setId($id);

        $this->fields[ $id ] = $field;

        return $field;
    }

    private function generateId(string $name): string
    {
        $sanitizedName = sanitize_title($name);
        $cache         = $this->fields;
        $fieldName     = $sanitizedName . '_0';

        if (isset($cache[ $fieldName ])) {
            $i = 1;
            while (isset($cache[ $sanitizedName . '_' . $i ])) {
                $i++;
            }
            $fieldName = $sanitizedName . '_' . $i;
        }

        return $fieldName;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getField(string $name): ?ElementInterface
    {
        return $this->fields[ $name ] ?? null;
    }
}
