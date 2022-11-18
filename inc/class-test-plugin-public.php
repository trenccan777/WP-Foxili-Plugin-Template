<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Test_Plugin_Public
{

    public static function register()
    {
        $plugin = new self();
        add_action('wp_enqueue_scripts', array($plugin, 'enqueue_scripts'));
    }

    public function enqueue_scripts()
    {

        wp_enqueue_script('test-plugin-public-scripts', TEST_PLUGIN_URL . 'assets/js/public.js', array('jquery'), TEST_PLUGIN_VERSION, false);
        wp_localize_script('test-plugin-public-scripts', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

    }

}
Test_Plugin_Public::register();
