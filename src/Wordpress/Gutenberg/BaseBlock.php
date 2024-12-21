<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Gutenberg;

abstract class BaseBlock
{
    protected bool $registerEndpoint = true;

    abstract public function getTag(): string;

    abstract public function render($attributes = array (), $content = ''): string;

    final private function __construct()
    {
    }

    public static function init(): static
    {
        $instance = new static();
        add_action('init', [$instance, 'register']);
        add_action('init', [$instance, 'registerAssets']);
        if ($instance->registerEndpoint) {
            add_action('rest_api_init', [$instance, 'registerEndpoint']);
        }
        return $instance;
    }

    public function register(): void
    {
        register_block_type('wp-stay-planner/' . $this->getTag(), [
            'editor_script'   => $this->getTag() . '-editor',
            'editor_style'    => $this->getTag() . '-editor-style',
            'style'           => $this->getTag() . '-style',
            'render_callback' => [$this, 'render'],
        ]);
    }

    protected function getAssetUrl(string $path): string
    {
        return sprintf(
            WP_STAY_PLANNER_PLUGIN_URL . '/assets/%s',
            ltrim($path, '/')
        );
    }

    protected function assetExists(string $path): bool
    {
        return file_exists(
            sprintf(
                WP_STAY_PLANNER_PLUGIN_PATH . '/assets/%s',
                ltrim($path, '/')
            ),
        );
    }

    public function registerAssets(): void
    {
        if ($this->assetExists('/js/block/' . $this->getTag() . '.js')) {
            wp_register_script(
                $this->getTag() . '-editor',
                $this->getAssetUrl('/js/block/' . $this->getTag() . '.js'),
                [
                    'wp-blocks',
                    'wp-i18n',
                    'wp-element',
                    'wp-editor',
                    'wp-components',
                ],
            );
        }

        if ($this->assetExists('/css/block/' . $this->getTag() . '/editor-style.css')) {
            wp_register_style(
                $this->getTag() . '-editor-style',
                $this->getAssetUrl('/css/block/search-bar/editor-style.css'),
                ['wp-edit-blocks'],
            );
        }

        if ($this->assetExists('/css/block/' . $this->getTag() . '/style.css')) {
            wp_register_style(
                $this->getTag() . '-style',
                $this->getAssetUrl('/css/block/' . $this->getTag() . '/style.css'),
            );
        }
    }

    public function registerEndpoint(): void
    {
        register_rest_route(
            'wp-stay-planner/v2',
            '/block/' . $this->getTag(),
            array (
                'methods'  => 'GET',
                'callback' => [$this, 'renderBlock'],
                'permission_callback' => function () {
                    return current_user_can('edit_posts');
                }
            )
        );
    }

    public function renderBlock(\WP_REST_Request $request): string
    {
        $attributes = $request->get_params();
        return $this->render($attributes);
    }

    public function getComponentBlockContainerClasses(): array
    {
        return [
            'wp-stay-planner-component',
            $this->getTag(),
        ];
    }
}
