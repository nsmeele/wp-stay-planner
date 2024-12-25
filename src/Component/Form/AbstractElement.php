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
            'label'    => null,
            'required' => false,
        ], $args);

        $this->args[ 'container_attr' ] = array_merge(
            $this->getDefaultContainerAttr(),
            $args[ 'container_attr' ] ?? array (),
        );

        $this->args[ 'widget_attr' ] = array_merge(
            $this->getDefaultWidgetAttr(),
            $args[ 'widget_attr' ] ?? array (),
        );

        if ($this->getWidgetAttribute('value')) {
            $this->setValue($this->getWidgetAttribute('value'));
            $this->setWidgetAttribute('value');
        }

        if (isset($args[ 'value' ])) {
            $this->setValue($args[ 'value' ]);
        }
    }

    abstract protected function getWidgetHtml(): string;

    public function renderLabel(): string
    {
        return sprintf(
            '<div class="form__element--label"><label for="%s">%s</label></div>',
            $this->getId(),
            $this->getLabelContent(),
        );
    }

    protected function getLabelContent(): string
    {
        $label = $this->getLabel();
        if ($this->args[ 'required' ]) {
            $label .= '<span class="form__element--required">*</span>';
        }

        $tooltip = $this->renderTooltip();
        if ($tooltip) {
            $label .= $tooltip;
        }
        return $label;
    }

    protected function renderHelpText() : string
    {
        return sprintf(
            '<div class="form__element--help">%s</div>',
            $this->args[ 'help' ] ?? '',
        );
    }

    protected function renderTooltip() : ?string
    {
        if (! empty($this->args[ 'tooltip' ])) {
            return sprintf(
                '<span class="form__element--tooltip" title="%s">?</span>',
                $this->args[ 'tooltip' ],
            );
        }
        return null;
    }

    public function __toString(): string
    {
        return sprintf(
            '<div %s>%s<div class="form__element--widget">%s</div>%s</div>',
            $this->renderAttributes($this->args[ 'container_attr' ]),
            $this->renderLabel(),
            $this->getWidgetHtml(),
            $this->renderHelpText(),
        );
    }

    final protected function renderAttributes(array $attributes = array ()): string
    {
        $string = '';

        $filterCallback = function ($value) {
            return $value !== false && $value !== null && $value !== '';
        };

        foreach (array_filter($attributes, $filterCallback) as $key => $value) {
            // Escape attributes to ensure security
            $key    = esc_attr($key);
            $value  = esc_attr($value);
            $string .= " $key=\"$value\"";
        }

        return $string;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): ElementInterface
    {
        $this->value = $value;
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
        return $this->args[ 'widget_attr' ] ?? array ();
    }

    public function getWidgetAttribute(string $attribute): ?string
    {
        return $this->args[ 'widget_attr' ][ $attribute ] ?? null;
    }

    public function setWidgetAttribute(string $attribute, ?string $value = null): ElementInterface
    {
        $this->args[ 'widget_attr' ][ $attribute ] = $value;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->getWidgetAttribute('id');
    }

    public function setId(string $id): ElementInterface
    {
        $this->setWidgetAttribute('id', $id);
        return $this;
    }

    protected function getDefaultContainerAttr(): array
    {
        return [
            'class' => 'form__element form__element--' . ElementFactory::getFieldType(static::class),
        ];
    }

    protected function getDefaultWidgetAttr(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
