<?php

namespace Nsmeele\WpStayPlanner\Component\Form;

enum ElementType: string
{
    case CHECKBOX = 'checkbox';
    case RADIO = 'radio';
    case DATE = 'date';
    case EMAIL = 'email';
    case REFERENCE = 'reference';
    case REPEATER = 'repeater';
    case SELECT = 'select';
    case TEXT = 'text';
    case NUMBER = 'number';
    case SUBMIT = 'submit';
    case BUTTON = 'button';
    case CONTAINER = 'container';
    case HIDDEN = 'hidden';
    case FILE = 'file';
    case PASSWORD = '';
    case TEXTAREA = 'textarea';
    case URL = 'url';
    case WYSIWYG = 'wysiwyg';
    case COLOR = 'color';
    case DATETIME = 'datetime';
    case DATETIME_LOCAL = 'datetime-local';

    /**
     * @return class-string<ElementInterface>
     */
    public function getFieldClass(): string
    {
        return match ($this) {
            self::CHECKBOX => FieldType\CheckboxField::class,
            self::RADIO => FieldType\RadioField::class,
            self::DATE => FieldType\DateField::class,
            self::EMAIL => FieldType\EmailField::class,
            self::REFERENCE => FieldType\ReferenceField::class,
            self::REPEATER => FieldType\RepeaterField::class,
            self::SELECT => FieldType\SelectField::class,
            self::NUMBER => FieldType\NumberField::class,
            self::SUBMIT => FieldType\SubmitField::class,
            default => FieldType\TextField::class,
        };
    }
}
