<?php
/*
 * Plugin Name: WP Stay Planner
 * Description: Complete management system for hotels, bed & breakfasts, vacation rentals and other accommodation providers.
 * Author: Nathalie Smeele
 * Author URI: https://nathaliesmeele.nl/
 * Version: 1.0.0
 * Requires PHP:      8.2
 * Requires at least: 6.7
 * Tested up to: 6.7
 */

use Nsmeele\WpStayPlanner\Wordpress;

if (! defined('ABSPATH')) {
    exit;
}

require_once __DIR__.'/vendor/autoload.php';

define('WP_STAY_PLANNER_VERSION', '1.0.0');
define('WP_STAY_PLANNER_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WP_STAY_PLANNER_PLUGIN_URL', plugins_url('', __FILE__));

$postTypeContainer = Wordpress\PostType\PostTypeContainer::getInstance();

foreach ($postTypeContainer->getPostTypes() as $postType) {
    $postType->init();
}

/**
 * Taxonomies
 */
Wordpress\Taxonomy\RoomTaxonomy::init();
Wordpress\Taxonomy\IntervalTaxonomy::init();
Wordpress\Taxonomy\AmenityTaxonomy::init();

/**
 * Shortcodes
 */
Wordpress\Shortcode\CalendarShortcode::init();
Wordpress\Shortcode\RoomsShortcode::init();

/**
 * Controllers
 */
Wordpress\Controller\SearchController::init();

/**
 * Gutenberg blocks
 */
function wp_stay_planner_register_block_category(array $categories = array ()) : array
{
    $categories[] = [
        'slug'  => 'wp-stay-planner',
        'title' => 'WP Stay Planner',
    ];

    return $categories;
}

add_filter('block_categories_all', 'wp_stay_planner_register_block_category');

Wordpress\Gutenberg\SearchBarBlock::init();

/**
 * Pages
 */
Wordpress\Page\DashboardPage::init();
add_action('admin_menu', function () use ($postTypeContainer)
{
    foreach ($postTypeContainer->getPostTypes() as $postType) {
        $postType->addToMenu();
    }
});
Wordpress\Page\SettingsPage::init();