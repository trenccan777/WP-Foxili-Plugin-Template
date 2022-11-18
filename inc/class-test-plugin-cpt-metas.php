<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Test_Plugin_CPT_Metas
{

    public static function register()
    {
        $plugin = new self();
        add_action('init', array($plugin, 'register_custom_posts_metas'));
    }

    public function register_custom_posts_metas() {

        $object_type = 'post';
        $object_subtype = 'custom-posts';

        $metas = array(
            'name' => array(
                'type' => 'string',
                // Custom post type
                'object_subtype' => $object_subtype,
                // Shown in the schema for the meta key.
                'description' => '',
                // Return a single value of the type.
                'single' => true,
                // Show in the WP REST API response. Default: false.
                'show_in_rest' => true,
                 //When registering complex meta data as objects and array
                //https://make.wordpress.org/core/2019/10/03/wp-5-3-supports-object-and-array-meta-types-in-the-rest-api/
            ),
        );

        foreach ($metas as $meta_key => $meta_args) {
            register_meta($object_type, $meta_key, $meta_args);
        }        
    }
}
Test_Plugin_CPT_Metas::register();
