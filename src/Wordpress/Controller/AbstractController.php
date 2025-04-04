<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Controller;

abstract class AbstractController
{
    abstract protected function getUri() : string;

    abstract public function getTemplate() : string;

    protected string $indexTemplate = '/templates/base.php';

    public static function init() : void
    {
        $instance = new static();
        add_action('init', [$instance, 'registerUri']);
        add_filter('query_vars', [$instance, 'registerQueryVar']);
        add_action('template_redirect', [$instance, 'renderTemplate']);
    }

    public function getQueryVar() : string
    {
        return str_replace('-', '_', sanitize_title('wp-stay-planner/' . $this->getUri()));
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

    public function registerQueryVar($vars) : array
    {
        $vars[] = $this->getQueryVar();
        return $vars;
    }

    final public function renderTemplate() : void
    {
        $var = $this->getQueryVar();
        if (get_query_var($var)) {
            $baseTemplate = WP_STAY_PLANNER_PLUGIN_PATH.ltrim($this->indexTemplate, '/');

            if (file_exists($baseTemplate)) {
                load_template(
                    $baseTemplate,
                    true,
                    [
                        'controller' => $this,
                    ]
                );
                exit();
            }
        }
    }

}
