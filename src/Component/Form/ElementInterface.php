<?php

namespace Nsmeele\WpStayPlanner\Component\Form;

interface ElementInterface
{
    public function setContainer(?ContainerInterface $container = null): ElementInterface;

    public function getContainer(): ?ContainerInterface;

    public function __toString(): string;

    public function getValue(): mixed;

    public function setValue(mixed $value): ElementInterface;

    public function getName(): ?string;

    public function setName(string $name): ElementInterface;

    public function getLabel(): ?string;

    public function setLabel(string $label): ElementInterface;

    public function getRegisterArgs(): array;

    public function getWidgetAttributes(): array;

    public function getWidgetAttribute(string $attribute): ?string;

    public function setWidgetAttribute(string $attribute, string $value): ElementInterface;
}
