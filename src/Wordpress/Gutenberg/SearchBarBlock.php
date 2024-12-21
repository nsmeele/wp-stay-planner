<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Gutenberg;

class SearchBarBlock extends BaseBlock
{
    public function getTag(): string
    {
        return 'search-bar';
    }

    public function render(
        $attributes = array (),
        $content = '',
    ): string {
        $form = new \Nsmeele\WpStayPlanner\Form\SearchForm();

        $containerClasses = $this->getComponentBlockContainerClasses();
        if (! empty($attributes[ 'align' ])) {
            $containerClasses[] = 'align' . $attributes[ 'align' ];
        }

        $containerClasses = array_filter($containerClasses);

        return sprintf(
            '<div class="%s">%s</div>',
            implode(' ', $containerClasses),
            $form,
        );
    }
}
