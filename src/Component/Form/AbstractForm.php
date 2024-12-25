<?php

namespace Nsmeele\WpStayPlanner\Component\Form;

abstract class AbstractForm extends AbstractContainer
{
    protected bool $renderSubmitButton = true;

    protected string $submitLabel = 'Submit';

    /**
     * @var ElementInterface[] Cache of created fields
     */
    private static array $fieldCache = [];

    protected function setSubmitLabel(string $label): ContainerInterface
    {
        $this->submitLabel = $label;
        return $this;
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
            $this->renderAttributes($this->getWidgetAttributes()),
            $this->getWidgetHtml(),
        );
    }

    public function getWidgetHtml(): string
    {
        $html = parent::getWidgetHtml();

        if ($this->renderSubmitButton) {
            $html .= $this->createElement('submit', 'submit', ['label' => $this->submitLabel])->__toString();
        }

        return $html;
    }

    protected function getDefaultWidgetAttr(): array
    {
        return [
            'class' => 'form',
            'method' => 'post',
            'action' => add_query_arg('find', '1'),
        ];
    }

    public function createElement(
        string $type,
        ?string $name = null,
        array $args = array ()
    ): ElementInterface {
        $field = parent::createElement($type, $name, $args);
        $id    = $field->getId() ?? self::generateId($name);
        $field->setId($id);

        self::$fieldCache[ $id ] = $field;

        return $field;
    }

    protected static function generateId(string $name): string
    {
        $sanitizedName = sanitize_title($name);
        $cache         = self::$fieldCache;
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
}
