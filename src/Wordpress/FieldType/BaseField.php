<?php

namespace Nsmeele\WpStayPlanner\Wordpress\FieldType;

abstract class BaseField implements FieldInterface
{
    public function __construct(
        protected ?string $name = null,
        protected array $args = array (),
    ) {
        $this->args = array_merge([
            'label'             => null,
            'required'          => false,
            'widget_attributes' => array ()
        ], $args);

        $this->args[ 'widget_attributes' ] = array_merge([
            'id'    => $this->name,
            'name'  => $this->name,
            'value' => $this->getValue(),
            'class' => '',
            'style' => '',
        ], $this->args[ 'widget_attributes' ]);
    }

    abstract protected function getWidgetHtml(): string;

    public function register(): void
    {
        register_meta('post', $this->name, $this->getRegisterArgs());
    }

    protected function getValue(): mixed
    {
        if (! empty($this->name)) {
            return get_post_meta(get_the_ID(), $this->name, true);
        }
        return null;
    }

    protected function getRegisterArgs(): array
    {
        $args = array_merge([
            'show_in_rest'      => false,
            'single'            => true,
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
        ], $this->args);

        if (! empty($this->args[ 'postType' ])) {
            $args[ 'object_subtype' ] = $this->args[ 'postType' ];
        }

        return $args;
    }

    public function __toString(): string
    {
        return sprintf(
            '<div class="form__element"><div class="form__element--label"><label for="%s">%s</label></div><div class="form__element--widget">%s</div></div>',
            $this->name,
            $this->args[ 'label' ] ?? null,
            $this->getWidgetHtml(),
        );
    }

    final protected function renderWidgetAttributes(): string
    {
        $attributes = '';

        foreach (array_filter($this->args[ 'widget_attributes' ]) as $key => $value) {
            // Escape attributes to ensure security
            $key        = esc_attr($key);
            $value      = esc_attr($value);
            $attributes .= " $key=\"$value\"";
        }

        return $attributes;
    }
}
