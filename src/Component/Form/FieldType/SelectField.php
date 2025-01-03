<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractElement;

class SelectField extends AbstractElement
{
    public function __construct(string $name, array $args = array ())
    {
        $defaultReferenceArgs = [
            'cardinality' => 1,
            'post_type'   => 'post',
            'orderby'     => 'title',
            'order'       => 'ASC',
        ];

        $args[ 'referenceArgs' ] = array_merge($defaultReferenceArgs, $args[ 'referenceArgs' ] ?? []);

        if (isset($args['single']) && $args['single'] === false) {
            $args['multiple'] = 'multiple';
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

        return sprintf(
            "<select %s>%s</select>",
            $this->renderAttributes($this->getWidgetAttributes()),
            $options,
        );
    }
}
