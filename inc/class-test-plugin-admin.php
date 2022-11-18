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
    }

    public function enqueue_scripts()
    {

        wp_enqueue_script('test-plugin-admin-scripts', TEST_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), TEST_PLUGIN_VERSION, false);
        wp_localize_script('test-plugin-admin-scripts', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

    }

}
Test_Plugin_Admin::register();
