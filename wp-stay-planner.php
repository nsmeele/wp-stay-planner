<?php
/*
 * Plugin Name: WP Stay Planner
 * Description: Complete management system for hotels, bed & breakfasts, vacation rentals and other accommodation providers.
 * Author: Nathalie Smeele
 * Author URI: https://nathaliesmeele.nl/
 */

namespace Nsmeele\WpStayPlanner;

if (! defined('ABSPATH')) {
    exit;
}

require_once __DIR__.'/vendor/autoload.php';

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

/**
 * Pages
 */
Wordpress\Page\DashboardPage::init();
add_action('admin_menu', function () use ($postTypeContainer) {
    foreach ($postTypeContainer->getPostTypes() as $postType) {
        $postType->addToMenu();
    }
});
Wordpress\Page\SettingsPage::init();