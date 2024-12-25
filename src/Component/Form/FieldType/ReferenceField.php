<?php

namespace Nsmeele\WpStayPlanner\Component\Form\FieldType;

use Nsmeele\WpStayPlanner\Component\Form\AbstractElement;
use Nsmeele\WpStayPlanner\Component\Form\ElementFactory;

class ReferenceField extends AbstractElement
{
    public function __construct(string $name, array $args = array ())
    {
        $args[ 'referenceArgs' ] = array_merge([
            'cardinality' => 1,
            'post_type'   => 'post',
            'orderby'     => 'title',
            'order'       => 'ASC',
        ], $args[ 'referenceArgs' ] ?? []);

        parent::__construct($name, $args);
    }

    protected function getWidgetHtml(): string
    {
        $referenceArgs = $this->args[ 'referenceArgs' ];

        $posts   = get_posts($referenceArgs);
        $options = array ();

        foreach ($posts as $post) {
            $options[ $post->ID ] = $post->post_title;
        }

        $selectWidgetAttributes = [];
        if ($this->args[ 'referenceArgs' ][ 'cardinality' ] > 1) {
            $selectWidgetAttributes = [
                'style' => 'display: none;',
            ];
        }

        $html = ElementFactory::create('select', $this->name, [
            'options'           => $options,
            'widget_attr' => $selectWidgetAttributes
        ])->getWidgetHtml();

        if ($this->args[ 'referenceArgs' ][ 'cardinality' ] > 1) {
            $html .= ElementFactory::create('text', null, [
                'label' => $this->args[ 'label' ],
            ])->getWidgetHtml();
        }

        return $html;
    }
}
