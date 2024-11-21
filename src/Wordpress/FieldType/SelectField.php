<?php

namespace Nsmeele\WpStayPlanner\Wordpress\FieldType;

class SelectField extends BaseField
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

        parent::__construct($name, $args);
    }

    protected function getWidgetHtml(): string
    {
        $options      = '<option ' . $this->renderWidgetAttributes() . '>Selecteer...</option>';
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
            "<select %s %s>%s</select>",
            $this->renderWidgetAttributes(),
            isset($this->args[ 'single' ]) && $this->args[ 'single' ] !== false ? 'multiple="multiple"' : '',
            $options
        );
    }
}
