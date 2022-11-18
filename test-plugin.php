<?php

/**
 * Plugin Name:       Test plugin
 * Description:       Test plugin description
 * Version:           1.0.0
 * Author:            Marek Chrást
 * Author URI:        marek@foxili.sk
 * Text Domain:       test-plugin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TEST_PLUGIN_VERSION', '1.0.0' );
define( 'TEST_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'TEST_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

if ( ! function_exists( 'test_plugin_init' ) ) {
	/**
	 * Start the plugin
	 */
	function test_plugin_init() {     
		require_once TEST_PLUGIN_PATH. 'inc/class-test-plugin.php';
		Test_Plugin::init();
	}
}

test_plugin_init();