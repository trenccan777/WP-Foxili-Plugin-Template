<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Test_Plugin_CPT
{

    public static function register()
    {
        $plugin = new self();
        add_action('init', array($plugin, 'register_custom_post_type'));
        add_action('init', array($plugin, 'register_custom_taxonomy'));
    }

    public function register_custom_post_type()
    {

        register_post_type('custom-posts', array(
            'labels' => array(
                'name' => __('Custom posts', 'test-plugin'),
                'singular_name' => __('Custom post', 'test-plugin'),
                'all_items' => __('All custom posts', 'test-plugin'),
                'new_item' => __('New posts', 'test-plugin'),
                'add_new' => __('Add New', 'test-plugin'),
                'add_new_item' => __('Add New custom Post', 'test-plugin'),
                'edit_item' => __('Edit custom post', 'test-plugin'),
                'view_item' => __('View custom post', 'test-plugin'),
                'search_items' => __('Search custom posts', 'test-plugin'),
                'not_found' => __('No custom posts found', 'test-plugin'),
                'not_found_in_trash' => __('No custom posts found in trash', 'test-plugin'),
                'parent_item_colon' => __('Parent custom posts', 'test-plugin'),
                'menu_name' => __('Custom posts', 'test-plugin'),
            ),
            'public' => true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'has_archive' => true,
            'rewrite' => true,
            'query_var' => true,
            'menu_icon' => 'dashicons-book-alt',
            'show_in_rest' => true,
            'rest_base' => 'custom-posts',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
        ));

    }

    public function register_custom_taxonomy() {
        $labels = array(
            'name' => _x('Custom taxonomies', 'Taxonomy General Name', 'test-plugin'),
            'singular_name' => _x('Custom Taxonomy', 'Taxonomy Singular Name', 'test-plugin'),
            'menu_name' => __('Custom taxonomies', 'test-plugin'),
            'all_items' => __('All Custom taxonomies', 'test-plugin'),
            'parent_item' => __('Parent Custom Taxonomy', 'test-plugin'),
            'parent_item_colon' => __('Parent Custom Taxonomy:', 'test-plugin'),
            'new_item_name' => __('New Custom Taxonomy Name', 'test-plugin'),
            'add_new_item' => __('Add New Custom Taxonomy', 'test-plugin'),
            'edit_item' => __('Edit Custom Taxonomy', 'test-plugin'),
            'update_item' => __('Update Custom Taxonomy', 'test-plugin'),
            'view_item' => __('View Custom Taxonomy', 'test-plugin'),
            'separate_items_with_commas' => __('Separate Custom taxonomies with commas', 'test-plugin'),
            'add_or_remove_items' => __('Add or remove Custom taxonomies', 'test-plugin'),
            'choose_from_most_used' => __('Choose from the most used', 'test-plugin'),
            'popular_items' => __('Popular Custom taxonomies', 'test-plugin'),
            'search_items' => __('Search Custom taxonomies', 'test-plugin'),
            'not_found' => __('Not Found', 'test-plugin'),
            'no_terms' => __('No Custom taxonomies', 'test-plugin'),
            'items_list' => __('Custom taxonomies list', 'test-plugin'),
            'items_list_navigation' => __('Custom taxonomies list navigation', 'test-plugin'),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_in_rest' => true,
            'rest_base' => 'custom-taxonomy',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        );
        register_taxonomy('custom-taxonomy', array('custom-posts'), $args);
    }
}
Test_Plugin_CPT::register();
