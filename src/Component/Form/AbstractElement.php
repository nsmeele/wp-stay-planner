<?php

namespace Nsmeele\WpStayPlanner\Component\Form;

use Nsmeele\WpStayPlanner\Component\HTMLElement;

abstract class AbstractElement implements ElementInterface
{
    protected mixed $value = null;

    protected ?ContainerInterface $container = null;

    protected ElementType $fieldType;

    protected HTMLElement $containerHtmlElement;

    public function __construct(
        protected ?string $name = null,
        protected array $args = [],
    ) {
        $this->args[ 'label' ]    ??= '';
        $this->args[ 'required' ] ??= false;

        if ($this->args[ 'type' ] instanceof ElementType === false) {
            throw new \InvalidArgumentException('Field type must be an instance of ElementType');
        }

        $this->fieldType = $this->args[ 'type' ];

        $this->containerHtmlElement = new HTMLElement(
            'div',
            array_merge(
                $this->getDefaultContainerAttr(),
                $args[ 'container_attr' ] ?? [],
            ),
            $this,
        );

        $this->args[ 'widget_attr' ] = array_merge(
            $this->getDefaultWidgetAttr(),
            $args[ 'widget_attr' ] ?? [],
        );

        if ($this->getWidgetAttribute('value')) {
            $this->setValue($this->getWidgetAttribute('value'));
            $this->setWidgetAttribute('value');
        }

        if (isset($args[ 'value' ])) {
            $this->setValue($args[ 'value' ]);
        }
    }

    abstract protected function getWidgetHtml(): string|HTMLElement;

    public function renderLabel(): string
    {
        return sprintf(
            '<div class="form__element--label"><label for="%s">%s</label></div>',
            esc_attr($this->getId()),
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
            $label .= esc_html($tooltip);
        }
        return $label;
    }

    protected function renderHelpText(): string
    {
        return new HTMLElement(
            'div',
            [
                'class' => 'form__element--help-text',
            ],
            $this->args[ 'help_text' ] ?? '',
        );
    }

    protected function renderTooltip(): ?string
    {
        if (! empty($this->args[ 'tooltip' ])) {
            return new HTMLElement(
                'span',
                [
                    'class' => 'form__element--tooltip',
                    'title' => $this->args[ 'tooltip' ],
                ],
                '?',
            );
        }
        return null;
    }

    public function __toString(): string
    {
        return new HTMLElement(
            'div',
            $this->args[ 'container_attr' ] ?? [],
            sprintf(
                '%s<div class="form__element--widget">%s</div>%s',
                $this->renderLabel(),
                $this->getWidgetHtml(),
                $this->renderHelpText(),
            ),
        );
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

    public function getLabel(): string
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
        return $this->args[ 'widget_attr' ] ?? [];
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
            'class' => 'form__element form__element--' . $this->fieldType->value,
        ];
    }

    protected function getDefaultWidgetAttr(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
