<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Controller;

abstract class AbstractController
{
    abstract protected function getUri() : string;

    abstract protected function getTemplate() : string;

    public static function init() : void
    {
        $instance = new static();
        add_action('init', [$instance, 'registerUri']);
        add_action('init', [$instance, 'registerPageTemplate']);
        add_filter('query_vars', [$instance, 'registerQueryVar']);
        add_filter('get_block_templates', [$instance, 'handleBlockTemplates']);
    }

    public function getQueryVar() : string
    {
        return str_replace('-', '_', sanitize_title($this->getUri()));
    }

    public function registerUri() : void
    {
        add_rewrite_rule(
            '^'.sanitize_title($this->getUri()).'?$',
            'index.php?'.$this->getQueryVar().'=1',
            'top'
        );

        flush_rewrite_rules();
    }

    protected function getTemplateName() : string
    {
        return 'wp-stay-planner//'.sanitize_title($this->getUri());
    }

    protected function getBlockTemplateArguments() : array
    {
        return [
            'plugin'     => 'wp-stay-planner',
            'post_types' => ['page'],
            'content'    => file_get_contents(
                WP_STAY_PLANNER_PLUGIN_PATH.'/templates/'.$this->getTemplate()
            ),
        ];
    }

    public function registerPageTemplate() : void
    {
        register_block_template(
            $this->getTemplateName(),
            $this->getBlockTemplateArguments(),
        );
    }

    public function registerQueryVar($vars) : array
    {
        $vars[] = $this->getQueryVar();
        return $vars;
    }

    public function handleBlockTemplates(array $query_result) : array
    {
        if (get_query_var($this->getQueryVar())) {
            $blockTemplate = get_block_template($this->getTemplateName());
            if ($blockTemplate) {
                return [$blockTemplate];
            }
        }

        return $query_result;
    }
}
