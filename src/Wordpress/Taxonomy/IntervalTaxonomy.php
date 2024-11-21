<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Taxonomy;

class IntervalTaxonomy extends BaseTaxonomy
{
    public function register(): void
    {
        register_taxonomy('interval', ['interval', 'season'], [
            'labels' => [
                'name' => 'Intervals',
                'singular_name' => 'Interval',
                'search_items' => 'Search Intervals',
                'all_items' => 'All Intervals',
                'parent_item' => 'Parent Interval',
                'parent_item_colon' => 'Parent Interval:',
                'edit_item' => 'Edit Interval',
                'update_item' => 'Update Interval',
                'add_new_item' => 'Add New Interval',
                'new_item_name' => 'New Interval Name',
                'menu_name' => 'Interval',
            ],
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => ['slug' => 'interval'],
        ]);
    }
}
