<?php

namespace Nsmeele\WpStayPlanner\Component\Form;

class ElementFactory
{
    public static function create(
        ?string $type = null,
        ?string $name = null,
        array $args = []
    ): ElementInterface {
        $type           = ElementType::from($type ?? 'text');
        $class          = $type->getFieldClass();
        $args[ 'type' ] = $type;

        return new $class(name: $name, args: $args);
    }

    /**
     * @param  string  $input  Example string: date|start_date|Start datum
     * @return array
     */
    public static function parseString(string $input): array
    {
        if (empty($input)) {
            throw new \InvalidArgumentException('Could not parse string: string is empty');
        }

        [$fieldType, $fieldName, $fieldLabel] = array_pad(
            explode('|', $input),
            3,
            null
        );

        return [
            'type'  => $fieldType,
            'name'  => $fieldName ?? null,
            'label' => $fieldLabel ?? null,
        ];
    }

    /**
     * @param  string  $input
     * @return ElementInterface
     */
    public static function createFromString(string $input): ElementInterface
    {
        $fieldData = self::parseString($input);
        return self::create(
            $fieldData[ 'type' ],
            $fieldData[ 'name' ],
            ['label' => $fieldData[ 'label' ]]
        );
    }
}
