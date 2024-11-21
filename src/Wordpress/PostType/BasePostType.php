<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

use Nsmeele\WpStayPlanner\Wordpress\FieldType\FieldInterface;

abstract class BasePostType implements PostTypeInterface
{
    public function init(): void
    {
        add_action('init', [$this, 'register']);
        add_action('add_meta_boxes', [$this, 'registerMetabox']);
        add_action('save_post', [$this, 'saveMetaboxData']);
    }

    abstract public function registerPostType(): void;

    abstract protected function getTag(): string;

    final protected function getDefaultProperties(): array
    {
        return [
            'public'       => false,
            'show_ui'      => true,
            'show_in_menu' => false,
            'supports'     => ['title'],
        ];
    }

    final public function register(): void
    {
        $this->registerPostType();
        $this->registerFields();
    }

    final public function addToMenu($parentSlug = 'stay-planner'): void
    {
        global $wp_post_types;

        if (empty($wp_post_types[ $this->getTag() ])) {
            return;
        }

        $postType = $wp_post_types[ $this->getTag() ];

        add_submenu_page(
            $parentSlug,
            $postType->labels->name,
            $postType->labels->name,
            'manage_options',
            'edit.php?post_type=' . $this->getTag(),
        );
    }

    /**
     * @return FieldInterface[]
     */
    protected function getFields(): array
    {
        return [];
    }

    private function registerFields(): void
    {
        $fields = $this->getFields();

        foreach ($fields as $field) {
            $field->register();
        }
    }

    protected function getMetaboxInfo(): array
    {
        return [
            'id'     => $this->getTag() . '_metabox',
            'title'  => 'Default',
            'screen' => [$this->getTag()],
        ];
    }

    public function registerMetabox(): void
    {
        $metaboxInfo = $this->getMetaboxInfo();
        if (! empty($this->getFields())) {
            add_meta_box(
                $metaboxInfo[ 'id' ],
                $metaboxInfo[ 'title' ],
                [$this, 'renderMetabox'],
                $metaboxInfo[ 'screen' ],
            );
        }
    }

    public function saveMetaboxData(int $postId): void
    {
    }

    public function renderMetabox($post): void
    {
        $metaboxInfo = $this->getMetaboxInfo();
        wp_nonce_field(basename(__FILE__), $metaboxInfo[ 'id' ] . '_nonce');

        $fields = static::getFields();
        foreach ($fields as $field) {
            echo $field;
        }
    }
}
