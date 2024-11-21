<?php

namespace Nsmeele\WpStayPlanner\Wordpress\FieldType;

class ReferenceField extends BaseField
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

        $html = FieldFactory::create('select', $this->name, [
            'options'           => $options,
            'widget_attributes' => $selectWidgetAttributes
        ])->getWidgetHtml();

        if ($this->args[ 'referenceArgs' ][ 'cardinality' ] > 1) {
            $html .= FieldFactory::create('text', null, [
                'label' => $this->args[ 'label' ],
            ])->getWidgetHtml();
        }

        return $html;
    }
}
