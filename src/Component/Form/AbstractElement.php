<?php

namespace Nsmeele\WpStayPlanner\Component\Form;

abstract class AbstractElement implements ElementInterface
{
    protected mixed $value = null;

    protected ?ContainerInterface $container = null;

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
            'class' => '',
            'style' => '',
        ], $this->args[ 'widget_attributes' ]);
    }

    abstract protected function getWidgetHtml(): string;

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

    public function getValue(): mixed
    {
        return $this->args[ 'widget_attributes' ][ 'value' ] ?? null;
    }

    public function setValue(mixed $value): ElementInterface
    {
        if ($value) {
            $this->setWidgetAttribute('value', $value);
        }

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->args[ 'label' ];
    }

    public function setLabel(string $label): ElementInterface
    {
        $this->args[ 'label' ] = $label;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): ElementInterface
    {
        $this->name = $name;
        return $this;
    }

    public function getRegisterArgs(): array
    {
        return [
            'show_in_rest'      => false,
            'single'            => true,
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
        ];
    }

    public function setContainer(?ContainerInterface $container = null): ElementInterface
    {
        $this->container = $container;
        return $this;
    }

    public function getContainer(): ?ContainerInterface
    {
        return $this->container;
    }

    public function getWidgetAttributes(): array
    {
        return $this->args[ 'widget_attributes' ] ?? array ();
    }

    public function getWidgetAttribute(string $attribute): ?string
    {
        return $this->args[ 'widget_attributes' ][ $attribute ] ?? null;
    }

    public function setWidgetAttribute(string $attribute, string $value): ElementInterface
    {
        $this->args[ 'widget_attributes' ][ $attribute ] = $value;
        return $this;
    }
}
