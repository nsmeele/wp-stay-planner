<?php

namespace Nsmeele\WpStayPlanner\Wordpress\Taxonomy;

class AmenityTaxonomy extends BaseTaxonomy
{
    public function register(): void
    {
        register_taxonomy('amenity', ['room'], [
            'labels'            => [
                'name'              => 'Amenities',
                'singular_name'     => 'Amenity',
                'search_items'      => 'Search Amenities',
                'all_items'         => 'All Amenities',
                'parent_item'       => 'Parent Amenity',
                'parent_item_colon' => 'Parent Amenity:',
                'edit_item'         => 'Edit Amenity',
                'update_item'       => 'Update Amenity',
                'add_new_item'      => 'Add New Amenity',
                'new_item_name'     => 'New Amenity Name',
                'menu_name'         => 'Amenity',
            ],
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'amenity'],

        ]);
    }
}
