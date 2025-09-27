<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractElement;
use Nsmeele\WpStayPlanner\Component\HTMLElement;

class SelectField extends AbstractElement
{
    public function __construct(?string $name = null, array $args = [])
    {
        $args[ 'referenceArgs' ]                  ??= [];
        $args[ 'referenceArgs' ][ 'cardinality' ] ??= 1;
        $args[ 'referenceArgs' ][ 'post_type' ]   ??= 'post';
        $args[ 'referenceArgs' ][ 'orderby' ]     ??= 'title';
        $args[ 'referenceArgs' ][ 'order' ]       ??= 'ASC';

        if (isset($args[ 'single' ]) && $args[ 'single' ] === false) {
            $args[ 'multiple' ] = 'multiple';
        }

        parent::__construct($name, $args);
    }

    protected function getWidgetHtml(): string
    {
        $options      = '<option value="">Selecteer...</option>';
        $currentValue = $this->getValue();

        if (! empty($this->args[ 'options' ])) {
            foreach ($this->args[ 'options' ] as $value => $label) {
                $options .= '<option value="' . $value . '" ' . selected(
                    $currentValue,
                    $value,
                    false
                ) . '>' . $label . '</option>';
            }
        }

        return (string) new HTMLElement(
            'select',
            $this->getWidgetAttributes(),
            $options,
        );
    }
}
