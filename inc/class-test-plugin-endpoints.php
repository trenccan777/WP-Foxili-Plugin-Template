<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Test_Plugin_Endpoints
{

    public static $plugin_name = 'test-plugin';


    public static function register()
    {
        $plugin = new self();
        add_action('rest_api_init', array($plugin, 'register_routes'));
    }

 
    public static function register_routes()
    {
        register_rest_route(self::$plugin_name . '/v1', '/data', array(
            array(
                'methods' => 'GET',
                'callback' => array(self::class, 'admin_settings_get_route'),
                'permission_callback' => '__return_true',
            ),
            array(
                'methods' => 'POST',
                'callback' => array(self::class, 'admin_settings_post_route'),
                'permission_callback' => function () {
                    return current_user_can('manage_options');
                },
            ),
        ));
    }

    public static function admin_settings_get_route()
    {
        $data = get_option(self::$plugin_name . 'settings');

        if (!$data) {
            $data = "empty";
        }

        return $data;
    }

    public static function admin_settings_post_route(\WP_REST_Request $request)
    {

        //Get react data
        $data = $request->get_json_params();
        if (!$data) {
            return new \WP_Error('no_data', __('No data found'), array('status' => 404));
        }

        $updated = update_option(self::$plugin_name . 'settings', $data);
        $data = get_option(self::$plugin_name . 'settings');

        return $data;

    }
}
Test_Plugin_Endpoints::register();
