<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

use Nsmeele\WpStayPlanner\Component\Form\ElementInterface;

abstract class AbstractPostType implements PostTypeInterface
{
    protected \WP_Post_Type $postType;

    abstract public function getTag(): string;

    public function init(): void
    {
        add_action('init', [$this, 'register']);
        add_action('add_meta_boxes', [$this, 'registerMetabox']);
        add_action('save_post_' . $this->getTag(), [$this, 'saveMetaboxData']);
        add_filter('parent_file', [$this, 'adminMenuSelected']);
    }

    final public function adminMenuSelected(string $parentFile): string
    {
        global $current_screen;

        if ($current_screen->post_type === $this->getTag()) {
            return 'stay-planner';
        }

        return $parentFile;
    }

    final public function register(): void
    {
        $this->registerPostType();
        $this->registerFields();
    }

    final public function registerPostType(): void
    {
        $postTypeObj = register_post_type(
            $this->getTag(),
            $this->getPostTypeProperties(),
        );

        $this->postType = $postTypeObj;
    }


    protected function getPostTypeProperties(): array
    {
        return [
            'public'       => false,
            'show_ui'      => true,
            'show_in_menu' => false,
            'supports'     => ['title'],
        ];
    }

    final public function addToMenu($parentSlug = 'stay-planner'): void
    {
        $postType = $this->postType;

        add_submenu_page(
            $parentSlug,
            $postType->labels->name,
            $postType->labels->name,
            'manage_options',
            'edit.php?post_type=' . $this->getTag(),
        );
    }

    /**
     * @return ElementInterface[]
     */
    protected function getFields(): array
    {
        return [];
    }

    private function registerFields(): void
    {
        $fields = $this->getFields();

        foreach ($fields as $field) {
            register_post_meta(
                $this->getTag(),
                $field->getName(),
                array_merge(
                    $field->getRegisterArgs(),
                    ['object_subtype' => $this->getTag(),]
                ),
            );
        }
    }

    protected function getMetaboxInfo(): array
    {
        return [
            'id'     => $this->getTag() . '_metabox',
            'title'  => __('WP Stay Planner'),
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
        if (
            ! wp_verify_nonce(
                $_POST[ $this->getTag() . '_metabox_nonce' ] ?? '',
                basename(__FILE__)
            )
        ) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (! current_user_can('edit_post', $postId)) {
            throw new \Exception('User cannot edit post');
        }

        foreach ($this->getFields() as $field) {
            $value = $_POST[ $field->getName() ] ?? null;
            if (! isset($value)) {
                continue;
            }

            update_post_meta($postId, $field->getName(), $value);
        }
    }

    public function renderMetabox($post): void
    {
        wp_nonce_field(
            basename(__FILE__),
            $this->getTag() . '_metabox_nonce',
        );

        $fields = static::getFields();
        foreach ($fields as $field) {
            if (! empty($field->getName())) {
                $currentValue = get_post_meta(
                    $post->ID,
                    $field->getName(),
                    $field->getRegisterArgs()[ 'single' ] ?? true
                );
                $field->setValue($currentValue);
            }

            echo $field;
        }
    }
}
