<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Test_Plugin_Admin
{

    public static function register()
    {
        $plugin = new self();
        add_action('admin_enqueue_scripts', array($plugin, 'enqueue_scripts'));
        add_action('admin_menu', array($plugin, 'add_menu_item'));
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script('test-plugin-admin-scripts', TEST_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), TEST_PLUGIN_VERSION, false);
        wp_localize_script('test-plugin-admin-scripts', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    }

    /**
    * Add the top level menu page.
    */
    public function add_menu_item() {
      
         add_menu_page(
            __('Plugin name', 'test-plugin'), //Page title
            __('Plugin name', 'test-plugin'), //Menu title
            'edit_others_posts',
            'test-plugin-settings',//page-slug
            function () {require_once plugin_dir_path(dirname(__FILE__)) . 'templates/test-plugin-settings-page.php';},
            'dashicons-visibility',
            11
        );

        /**
         * Adds a submenu page under a custom post type parent.
         */
        add_submenu_page(
            'test-plugin-settings',
            __('Podstránka', 'test-plugin'),
            __('Podstránka', 'test-plugin'),
            'edit_others_posts',
            'edit.php?post_type=post',
        );

    }

}
Test_Plugin_Admin::register();
