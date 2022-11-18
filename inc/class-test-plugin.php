<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Test_Plugin
{

    public static function init()
    {



       if(is_admin()) {
        require_once TEST_PLUGIN_PATH . 'inc/class-test-plugin-admin.php';
       }

       require_once TEST_PLUGIN_PATH . 'inc/class-test-plugin-public.php';
       require_once TEST_PLUGIN_PATH . 'inc/class-test-plugin-cpt.php';
       require_once TEST_PLUGIN_PATH . 'inc/class-test-plugin-cpt-metas.php';
       require_once TEST_PLUGIN_PATH . 'inc/class-test-plugin-metaboxes.php';
       require_once TEST_PLUGIN_PATH . 'inc/class-test-plugin-endpoints.php';

       require_once TEST_PLUGIN_PATH. 'inc/test-plugin-functions.php';   
            
    }
}
