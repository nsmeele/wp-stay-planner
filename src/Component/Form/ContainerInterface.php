<?php

namespace Nsmeele\WpStayPlanner\Component\Form;

interface ContainerInterface
{
    public function setValues(array $values = array ()): ContainerInterface;

    public function getValues(): array;

    /**
     * @return ElementInterface[]
     */
    public function getFields(): array;

    public function createElement(
        string $type,
        ?string $name = null,
        array $args = array ()
    ): ElementInterface;

    public function getField(string $name): ?ElementInterface;
}
