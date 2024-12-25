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
        $form->setValues([
            'start_date' => date('Y-m-d', strtotime('next saturday')),
            'end_date'   => date('Y-m-d', strtotime('next sunday')),
            'rooms'      => 1,
            'adults'     => 2,
            'children'   => 0,
        ]);

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
