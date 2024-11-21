<?php

namespace Nsmeele\WpStayPlanner\Wordpress\FieldType;

class FieldFactory
{
    public static function create(
        string $type,
        ?string $name = null,
        array $args = array ()
    ): FieldInterface {
        $class = 'Nsmeele\WpStayPlanner\Wordpress\FieldType\\' . ucfirst($type) . 'Field';
        return new $class(
            $name,
            $args
        );
    }

    /**
     * @param  string  $input Example string: date|start_date|Start datum
     * @return array
     */
    public static function parseString(string $input): array
    {
        if (empty($input)) {
            throw new \InvalidArgumentException('Empty string given');
        }

        [$fieldType, $fieldName, $fieldLabel] = array_pad(explode('|', $input), 3, null);
        return [
            'type'  => $fieldType,
            'name'  => $fieldName,
            'label' => $fieldLabel,
        ];
    }

    /**
     * @param  string  $input
     * @return FieldInterface
     */
    public static function createFromString(string $input): FieldInterface
    {
        $fieldData = self::parseString($input);
        return self::create(
            $fieldData[ 'type' ],
            $fieldData[ 'name' ],
            ['label' => $fieldData[ 'label' ]]
        );
    }
}
