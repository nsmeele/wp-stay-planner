<?php

namespace Nsmeele\WpStayPlanner\Component;

final class HTMLElement implements \Stringable
{
    public function __construct(
        private(set) string $tag,
        private(set) array $attributes = [],
        private(set) string|\Stringable $content = '',
    ) {
    }

    public function setContent(string|\Stringable $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function addContent(string|\Stringable $content): static
    {
        $this->content .= $content;
        return $this;
    }

    public function setAttribute(string $attribute, ?string $value = null): static
    {
        $this->attributes[ $attribute ] = $value;
        return $this;
    }

    private function renderAttributes(): string
    {
        $string = '';

        $filterCallback = function ($value) {
            return $value !== false && $value !== null && $value !== '';
        };

        foreach (array_filter($this->attributes, $filterCallback) as $key => $value) {
            // Escape attributes to ensure security
            $key    = esc_attr($key);
            $value  = esc_attr($value);
            $string .= " $key=\"$value\"";
        }

        return $string;
    }

    public function __toString(): string
    {
        return match ($this->tag) {
            'input', 'img' => sprintf(
                '<%s %s/>',
                $this->tag,
                $this->renderAttributes(),
            ),
            default => sprintf(
                '<%s>%s</%s>',
                $this->tag . ' ' . $this->renderAttributes(),
                $this->content,
                $this->tag
            )
        };
    }
}
