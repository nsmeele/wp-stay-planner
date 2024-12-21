<?php

namespace Nsmeele\WpStayPlanner\Component\Form;

class ElementFactory
{
    const FIELD_TYPES = [
        'checkbox'  => FieldType\CheckboxField::class,
        'date'      => FieldType\DateField::class,
        'email'     => FieldType\EmailField::class,
        'reference' => FieldType\ReferenceField::class,
        'repeater'  => FieldType\RepeaterField::class,
        'select'    => FieldType\SelectField::class,
        'text'      => FieldType\TextField::class,
        'number'    => FieldType\NumberField::class,
        'submit'    => FieldType\SubmitField::class,
        'button'    => FieldType\ButtonField::class,
    ];

    public static function create(
        string $type,
        ?string $name = null,
        array $args = array ()
    ): ElementInterface {
        if (! array_key_exists($type, self::FIELD_TYPES)) {
            throw new \InvalidArgumentException('Invalid field type');
        }

        $fieldClass = self::FIELD_TYPES[ $type ];
        return new $fieldClass($name, $args);
    }

    /**
     * @param  string  $input  Example string: date|start_date|Start datum
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
